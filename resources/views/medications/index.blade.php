<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('薬の管理') }}
            </h2>
            <a href="{{ route('medications.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                登録
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($medications->isEmpty())
                        <p class="text-gray-500 text-center py-8">まだ薬が登録されていません。</p>
                    @else
                        <div class="space-y-4">
                            @foreach($medications as $medication)
                                <div class="border rounded-lg p-4 {{ $medication->is_active ? '' : 'bg-gray-50 opacity-60' }}">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold">{{ $medication->name }}</h3>
                                            @if($medication->dosage)
                                                <p class="text-sm text-gray-600">用量: {{ $medication->dosage }}</p>
                                            @endif
                                            <div class="mt-2 flex flex-wrap gap-2">
                                                @foreach($medication->timing as $time)
                                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">
                                                        @switch($time)
                                                            @case('morning') 朝 @break
                                                            @case('afternoon') 昼 @break
                                                            @case('evening') 夕 @break
                                                            @case('night') 夜 @break
                                                            @case('bedtime') 就寝前 @break
                                                        @endswitch
                                                    </span>
                                                @endforeach
                                            </div>
                                            @if($medication->notes)
                                                <p class="mt-2 text-sm text-gray-600">{{ $medication->notes }}</p>
                                            @endif
                                            @if(!$medication->is_active)
                                                <p class="mt-2 text-sm text-red-600">（使用停止中）</p>
                                            @endif
                                        </div>
                                        <div class="flex gap-2 ml-4">
                                            <a href="{{ route('medications.edit', $medication) }}" class="text-blue-600 hover:text-blue-800">
                                                編集
                                            </a>
                                            <form action="{{ route('medications.destroy', $medication) }}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    削除
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>