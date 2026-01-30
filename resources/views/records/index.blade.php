<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記録一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">メンタルヘルス記録</h3>
                        <a href="{{ route('records.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            新規記録
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($records->count() > 0)
                        <div class="space-y-4">
                            @foreach ($records as $record)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-500 mb-2">{{ $record->date->format('Y年m月d日') }}</p>
                                            <div class="grid grid-cols-2 gap-4 mb-2">
                                                <div>
                                                    <span class="text-sm font-medium">気分スコア:</span>
                                                    <span class="text-sm">{{ $record->mood_score ?? '未記入' }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-sm font-medium">睡眠時間:</span>
                                                    <span class="text-sm">{{ $record->sleep_hours ?? '未記入' }}時間</span>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">服薬:</span>
                                                <span class="text-sm">{{ $record->took_medication ? 'あり' : 'なし' }}</span>
                                            </div>
                                            @if ($record->note)
                                                <p class="text-sm text-gray-700 mt-2">{{ Str::limit($record->note, 100) }}</p>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2 ml-4 items-center">
                                            <a href="{{ route('records.edit', $record) }}" 
                                               class="text-blue-600 hover:text-blue-900 text-sm">編集</a>
                                            <form action="{{ route('records.destroy', $record) }}" method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('本当に削除しますか？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                                    削除
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">まだ記録がありません。新規記録から始めましょう。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>