<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
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
        return view('records.create');
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
        ]);

        Record::create([
            'user_id' => auth()->id(),
            ...$validated,
        ]);

        return redirect()->route('records.index')
            ->with('success', '記録を保存しました');
    }

    /**
     * 指定されたリソースを表示する
     */
    public function show(Record $record)
    {
        $this->authorize('view', $record);
        return view('records.show', compact('record'));
    }

    /**
     * 指定されたリソースの編集フォームを表示する
     */
    public function edit(Record $record)
    {
        $this->authorize('update', $record);
        return view('records.edit', compact('record'));
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
        ]);

        $record->update($validated);

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
