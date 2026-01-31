<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシュボード') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 統計カード -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-600 mb-2">総記録数</div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalRecords }}</div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-600 mb-2">今週の平均気分</div>
                    <div class="text-3xl font-bold text-blue-600">{{ number_format($avgMood, 1) ?? '-' }}</div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-600 mb-2">今週の平均睡眠</div>
                    <div class="text-3xl font-bold text-green-600">{{ number_format($avgSleep, 1) ?? '-' }}h</div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-600 mb-2">今週の服薬率</div>
                    <div class="text-3xl font-bold text-purple-600">{{ number_format($medicationRate, 0) }}%</div>
                </div>
            </div>

            <!-- グラフ -->
            @if ($chartData->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">過去7日間の気分推移</h3>
                    <canvas id="dashboardChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
            @endif

            <!-- 最新の記録 -->
            @if ($recentRecords->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">最近の記録</h3>
                        <a href="{{ route('records.index') }}" class="text-sm text-blue-600 hover:text-blue-900">すべて見る</a>
                    </div>
                    <div class="space-y-3">
                        @foreach ($recentRecords as $record)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $record->date->format('Y年m月d日') }}</p>
                                    <div class="mt-1 text-sm">
                                        気分: {{ $record->mood_score ?? '-' }} | 
                                        睡眠: {{ $record->sleep_hours ?? '-' }}h | 
                                        服薬: {{ $record->took_medication ? 'あり' : 'なし' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if ($chartData->count() > 0)
    <script type="module">
        const chartData = @json($chartData);
        const labels = chartData.map(d => d.date);
        const moodScores = chartData.map(d => d.mood_score);

        new window.Chart(document.getElementById('dashboardChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '気分スコア',
                    data: moodScores,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10
                    }
                }
            }
        });
    </script>
    @endif
</x-app-layout>
