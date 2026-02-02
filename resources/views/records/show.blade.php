<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記録詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-4">{{ $record->date->format('Y年m月d日') }}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-blue-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-600">気分スコア</span>
                                </div>
                                @if($record->mood_score)
                                    <p class="text-3xl font-bold text-blue-600">{{ $record->mood_score }}</p>
                                @else
                                    <p class="text-lg text-gray-400">未記入</p>
                                @endif
                            </div>
                            
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-600">睡眠時間</span>
                                </div>
                                @if($record->sleep_hours)
                                    <p class="text-3xl font-bold text-green-600">{{ $record->sleep_hours }}<span class="text-lg">時間</span></p>
                                @else
                                    <p class="text-lg text-gray-400">未記入</p>
                                @endif
                            </div>
                            
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-purple-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-600">服薬記録</span>
                                </div>
                                @if($record->medicationLogs->count() > 0)
                                    <p class="text-lg font-semibold text-purple-600">{{ $record->medicationLogs->count() }}件</p>
                                @else
                                    <p class="text-lg text-gray-400">なし</p>
                                @endif
                            </div>
                        </div>

                        <!-- 服薬記録詳細 -->
                        @if($record->medicationLogs->count() > 0)
                        <div class="border rounded-lg p-4 bg-purple-50 mb-6">
                            <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-purple-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                                服薬記録の詳細
                            </h4>
                            <div class="space-y-2">
                                @foreach($record->medicationLogs as $log)
                                    <div class="flex items-center justify-between bg-white rounded px-3 py-2">
                                        <div class="flex items-center">
                                            <span class="font-medium text-gray-800">{{ $log->display_name }}</span>
                                            <span class="ml-3 text-sm px-2 py-1 bg-purple-100 text-purple-800 rounded">
                                                @switch($log->timing)
                                                    @case('morning') 朝 @break
                                                    @case('afternoon') 昼 @break
                                                    @case('evening') 夕 @break
                                                    @case('night') 夜 @break
                                                    @case('bedtime') 就寝前 @break
                                                    @case('as_needed') 頓服 @break
                                                @endswitch
                                            </span>
                                        </div>
                                        @if($log->taken)
                                            <span class="text-green-600 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <span class="ml-1 text-sm">服用</span>
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">未服用</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        @if ($record->note)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <h4 class="font-medium text-gray-700 mb-2">メモ</h4>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $record->note }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <a href="{{ route('records.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            一覧へ
                        </a>
                        <div class="flex space-x-4">
                            <a href="{{ route('records.edit', $record) }}" class="text-blue-600 hover:text-blue-900">編集</a>
                            <form action="{{ route('records.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
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