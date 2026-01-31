<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            心の整理 - 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-4">{{ $thought->date->format('Y年m月d日') }}</h3>
                        
                        @if ($thought->situation)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">①</span>
                                状況
                            </h4>
                            <p class="text-gray-700 whitespace-pre-wrap pl-8">{{ $thought->situation }}</p>
                        </div>
                        @endif

                        @if ($thought->emotion || $thought->emotion_intensity)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">②</span>
                                気分・感情
                            </h4>
                            <div class="pl-8">
                                @if ($thought->emotion)
                                    <p class="text-gray-700 mb-2">{{ $thought->emotion }}</p>
                                @endif
                                @if ($thought->emotion_intensity)
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-4 mr-3">
                                            <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $thought->emotion_intensity }}%"></div>
                                        </div>
                                        <span class="text-blue-600 font-bold">{{ $thought->emotion_intensity }}%</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if ($thought->automatic_thought)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">③</span>
                                自動思考
                            </h4>
                            <p class="text-gray-700 whitespace-pre-wrap pl-8">{{ $thought->automatic_thought }}</p>
                        </div>
                        @endif

                        @if ($thought->evidence)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">④</span>
                                根拠
                            </h4>
                            <p class="text-gray-700 whitespace-pre-wrap pl-8">{{ $thought->evidence }}</p>
                        </div>
                        @endif

                        @if ($thought->counter_evidence)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">⑤</span>
                                反証
                            </h4>
                            <p class="text-gray-700 whitespace-pre-wrap pl-8">{{ $thought->counter_evidence }}</p>
                        </div>
                        @endif

                        @if ($thought->adaptive_thought)
                        <div class="mb-6 p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">⑥</span>
                                適応的思考（バランスの取れた考え）
                            </h4>
                            <p class="text-gray-700 whitespace-pre-wrap pl-8">{{ $thought->adaptive_thought }}</p>
                        </div>
                        @endif

                        @if ($thought->emotion_after !== null)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">⑦</span>
                                その後の気分の強さ
                            </h4>
                            <div class="pl-8">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-4 mr-3">
                                        <div class="bg-green-600 h-4 rounded-full" style="width: {{ $thought->emotion_after }}%"></div>
                                    </div>
                                    <span class="text-green-600 font-bold">{{ $thought->emotion_after }}%</span>
                                </div>
                                @if ($thought->emotion_intensity && $thought->emotion_after < $thought->emotion_intensity)
                                    <p class="text-sm text-green-600 mt-2">
                                        ↓ {{ $thought->emotion_intensity - $thought->emotion_after }}% 軽減
                                    </p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <a href="{{ route('thoughts.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← 一覧に戻る
                        </a>
                        <div class="flex space-x-4">
                            <a href="{{ route('thoughts.edit', $thought) }}" class="text-blue-600 hover:text-blue-900">編集</a>
                            <form action="{{ route('thoughts.destroy', $thought) }}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>