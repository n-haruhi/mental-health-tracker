<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\MedicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThoughtRecordController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/records');
    }
    return redirect('/login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // 統計データ
    $totalRecords = \App\Models\Record::where('user_id', $user->id)->count();
    
    $weekStart = now()->startOfWeek();
    $weekRecords = \App\Models\Record::where('user_id', $user->id)
        ->where('date', '>=', $weekStart)
        ->with('medicationLogs')
        ->get();
    
    $avgMood = $weekRecords->avg('mood_score');
    $avgSleep = $weekRecords->avg('sleep_hours');
    
    // 服薬率：服薬ログがある記録の割合
    $recordsWithMedication = $weekRecords->filter(function ($record) {
        return $record->medicationLogs->count() > 0;
    })->count();
    $medicationRate = ($recordsWithMedication / max($weekRecords->count(), 1)) * 100;
    
    // 過去7日間のグラフデータ
    $chartData = \App\Models\Record::where('user_id', $user->id)
        ->where('date', '>=', now()->subDays(7))
        ->orderBy('date', 'asc')
        ->get()
        ->map(function ($record) {
            return [
                'date' => $record->date->format('m/d'),
                'mood_score' => $record->mood_score,
            ];
        });
    
    // 最新3件（服薬ログも読み込む）
    $recentRecords = \App\Models\Record::where('user_id', $user->id)
        ->with('medicationLogs')
        ->orderBy('date', 'desc')
        ->take(3)
        ->get();
    
    return view('dashboard', compact('totalRecords', 'avgMood', 'avgSleep', 'medicationRate', 'chartData', 'recentRecords'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('records', RecordController::class);
    Route::resource('thoughts', ThoughtRecordController::class);
    Route::resource('medications', MedicationController::class);
});

require __DIR__.'/auth.php';