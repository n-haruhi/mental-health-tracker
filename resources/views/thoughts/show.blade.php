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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            一覧へ
                        </a>
                        <div class="flex space-x-4">
                            <a href="{{ route('thoughts.edit', $thought) }}" class="text-blue-600 hover:text-blue-900 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                編集
                            </a>
                            <form action="{{ route('thoughts.destroy', $thought) }}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    削除
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>