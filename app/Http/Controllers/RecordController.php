<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Medication;
use App\Models\MedicationLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecordController extends Controller
{
    use AuthorizesRequests;

    /**
     * リソースの一覧を表示する
     */
    public function index()
    {
        $records = Record::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();

        // グラフ用データ（過去30日分）
        $chartData = Record::where('user_id', auth()->id())
            ->where('date', '>=', now()->subDays(30))
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($record) {
                return [
                    'date' => $record->date->format('Y-m-d'),
                    'mood_score' => $record->mood_score,
                    'sleep_hours' => $record->sleep_hours,
                ];
            });

        return view('records.index', compact('records', 'chartData'));
    }

    /**
     * 新規リソース作成フォームを表示する
     */
    public function create()
    {
        $medications = auth()->user()->medications()->where('is_active', true)->get();
        return view('records.create', compact('medications'));
    }

    /**
     * 新規作成されたリソースをストレージに保存する
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'mood_score' => 'nullable|integer|min:1|max:10',
            'sleep_hours' => 'nullable|numeric|min:0|max:24',
            'note' => 'nullable|string',
            'took_medication' => 'boolean',
            'medication_logs' => 'nullable|array',
            'medication_logs.*.medication_id' => 'nullable|exists:medications,id',
            'medication_logs.*.medication_name' => 'nullable|string|max:255',
            'medication_logs.*.timing' => 'required|string',
            'medication_logs.*.taken' => 'boolean',
        ]);

        $record = Record::create([
            'user_id' => auth()->id(),
            'date' => $validated['date'],
            'mood_score' => $validated['mood_score'] ?? null,
            'sleep_hours' => $validated['sleep_hours'] ?? null,
            'note' => $validated['note'] ?? null,
            'took_medication' => $validated['took_medication'] ?? false,
        ]);

        // 服薬ログを保存
        if (!empty($validated['medication_logs'])) {
            foreach ($validated['medication_logs'] as $log) {
                $record->medicationLogs()->create($log);
            }
        }

        return redirect()->route('records.index')
            ->with('success', '記録を保存しました');
    }

    /**
     * 指定されたリソースを表示する
     */
    public function show(Record $record)
    {
        $this->authorize('view', $record);
        $record->load('medicationLogs.medication');
        return view('records.show', compact('record'));
    }

    /**
     * 指定されたリソースの編集フォームを表示する
     */
    public function edit(Record $record)
    {
        $this->authorize('update', $record);
        $medications = auth()->user()->medications()->where('is_active', true)->get();
        $record->load('medicationLogs.medication');
        return view('records.edit', compact('record', 'medications'));
    }

    /**
     * 指定されたリソースをストレージ内で更新する
     */
    public function update(Request $request, Record $record)
    {
        $this->authorize('update', $record);

        $validated = $request->validate([
            'date' => 'required|date',
            'mood_score' => 'nullable|integer|min:1|max:10',
            'sleep_hours' => 'nullable|numeric|min:0|max:24',
            'note' => 'nullable|string',
            'took_medication' => 'boolean',
            'medication_logs' => 'nullable|array',
            'medication_logs.*.medication_id' => 'nullable|exists:medications,id',
            'medication_logs.*.medication_name' => 'nullable|string|max:255',
            'medication_logs.*.timing' => 'required|string',
            'medication_logs.*.taken' => 'boolean',
        ]);

        $record->update([
            'date' => $validated['date'],
            'mood_score' => $validated['mood_score'] ?? null,
            'sleep_hours' => $validated['sleep_hours'] ?? null,
            'note' => $validated['note'] ?? null,
            'took_medication' => $validated['took_medication'] ?? false,
        ]);

        // 既存の服薬ログを削除して新しく作成
        $record->medicationLogs()->delete();
        if (!empty($validated['medication_logs'])) {
            foreach ($validated['medication_logs'] as $log) {
                $record->medicationLogs()->create($log);
            }
        }

        return redirect()->route('records.index')
            ->with('success', '記録を更新しました');
    }

    /**
     * 指定されたリソースをストレージから削除する
     */
    public function destroy(Record $record)
    {
        $this->authorize('delete', $record);
        $record->delete();

        return redirect()->route('records.index')
            ->with('success', '記録を削除しました');
    }
}
