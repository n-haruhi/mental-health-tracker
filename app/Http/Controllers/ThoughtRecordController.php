<?php

namespace App\Http\Controllers;

use App\Models\ThoughtRecord;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ThoughtRecordController extends Controller
{
    use AuthorizesRequests;

    /**
     * 一覧を表示
     */
    public function index()
    {
        $thoughts = ThoughtRecord::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();

        return view('thoughts.index', compact('thoughts'));
    }

    /**
     * 新規作成フォームを表示
     */
    public function create()
    {
        return view('thoughts.create');
    }

    /**
     * 新規作成を保存
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'situation' => 'nullable|string',
            'emotion' => 'nullable|string',
            'emotion_intensity' => 'nullable|integer|min:0|max:100',
            'automatic_thought' => 'nullable|string',
            'evidence' => 'nullable|string',
            'counter_evidence' => 'nullable|string',
            'adaptive_thought' => 'nullable|string',
            'emotion_after' => 'nullable|integer|min:0|max:100',
        ]);

        ThoughtRecord::create([
            'user_id' => auth()->id(),
            ...$validated,
        ]);

        return redirect()->route('thoughts.index')
            ->with('success', '心の整理を保存しました');
    }

    /**
     * 詳細を表示
     */
    public function show(ThoughtRecord $thought)
    {
        $this->authorize('view', $thought);
        return view('thoughts.show', compact('thought'));
    }

    /**
     * 編集フォームを表示
     */
    public function edit(ThoughtRecord $thought)
    {
        $this->authorize('update', $thought);
        return view('thoughts.edit', compact('thought'));
    }

    /**
     * 更新を保存
     */
    public function update(Request $request, ThoughtRecord $thought)
    {
        $this->authorize('update', $thought);

        $validated = $request->validate([
            'date' => 'required|date',
            'situation' => 'nullable|string',
            'emotion' => 'nullable|string',
            'emotion_intensity' => 'nullable|integer|min:0|max:100',
            'automatic_thought' => 'nullable|string',
            'evidence' => 'nullable|string',
            'counter_evidence' => 'nullable|string',
            'adaptive_thought' => 'nullable|string',
            'emotion_after' => 'nullable|integer|min:0|max:100',
        ]);

        $thought->update($validated);

        return redirect()->route('thoughts.index')
            ->with('success', '心の整理を更新しました');
    }

    /**
     * 削除
     */
    public function destroy(ThoughtRecord $thought)
    {
        $this->authorize('delete', $thought);
        $thought->delete();

        return redirect()->route('thoughts.index')
            ->with('success', '心の整理を削除しました');
    }
}