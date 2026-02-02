<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = auth()->user()->medications()->orderBy('created_at', 'desc')->get();
        return view('medications.index', compact('medications'));
    }

    public function create()
    {
        return view('medications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'timing' => 'required|array|min:1',
            'timing.*' => 'in:morning,afternoon,evening,night,bedtime',
            'notes' => 'nullable|string',
        ]);

        auth()->user()->medications()->create($validated);

        return redirect()->route('medications.index')->with('success', '薬を登録しました。');
    }

    public function edit(Medication $medication)
    {
        $this->authorize('update', $medication);
        return view('medications.edit', compact('medication'));
    }

    public function update(Request $request, Medication $medication)
    {
        $this->authorize('update', $medication);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'timing' => 'required|array|min:1',
            'timing.*' => 'in:morning,afternoon,evening,night,bedtime',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $medication->update($validated);

        return redirect()->route('medications.index')->with('success', '薬を更新しました。');
    }

    public function destroy(Medication $medication)
    {
        $this->authorize('delete', $medication);
        $medication->delete();

        return redirect()->route('medications.index')->with('success', '薬を削除しました。');
    }
}
