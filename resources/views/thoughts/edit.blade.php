<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            心の整理 - 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('thoughts.update', $thought) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                記録日 <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="date" 
                                   value="{{ old('date', $thought->date->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   required>
                            @error('date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="situation" class="block text-sm font-medium text-gray-700 mb-2">
                                ① 状況
                            </label>
                            <textarea name="situation" id="situation" rows="3"
                                      placeholder="いつ、どこで、誰と、何があったか"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('situation', $thought->situation) }}</textarea>
                            @error('situation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="emotion" class="block text-sm font-medium text-gray-700 mb-2">
                                ② 気分・感情
                            </label>
                            <input type="text" name="emotion" id="emotion" 
                                   value="{{ old('emotion', $thought->emotion) }}"
                                   placeholder="どう感じたか"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('emotion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="emotion_intensity" class="block text-sm font-medium text-gray-700 mb-2">
                                気分の強さ (0-100%)
                            </label>
                            <input type="number" name="emotion_intensity" id="emotion_intensity" 
                                   value="{{ old('emotion_intensity', $thought->emotion_intensity) }}"
                                   min="0" max="100"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('emotion_intensity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="automatic_thought" class="block text-sm font-medium text-gray-700 mb-2">
                                ③ 自動思考
                            </label>
                            <textarea name="automatic_thought" id="automatic_thought" rows="4"
                                      placeholder="そのとき頭に浮かんだ考え"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('automatic_thought', $thought->automatic_thought) }}</textarea>
                            @error('automatic_thought')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="evidence" class="block text-sm font-medium text-gray-700 mb-2">
                                ④ 根拠
                            </label>
                            <textarea name="evidence" id="evidence" rows="3"
                                      placeholder="その考えを支持する事実"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('evidence', $thought->evidence) }}</textarea>
                            @error('evidence')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="counter_evidence" class="block text-sm font-medium text-gray-700 mb-2">
                                ⑤ 反証
                            </label>
                            <textarea name="counter_evidence" id="counter_evidence" rows="3"
                                      placeholder="その考えに反する事実"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('counter_evidence', $thought->counter_evidence) }}</textarea>
                            @error('counter_evidence')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="adaptive_thought" class="block text-sm font-medium text-gray-700 mb-2">
                                ⑥ 適応的思考（バランスの取れた考え）
                            </label>
                            <textarea name="adaptive_thought" id="adaptive_thought" rows="4"
                                      placeholder="別の見方、より現実的な考え"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('adaptive_thought', $thought->adaptive_thought) }}</textarea>
                            @error('adaptive_thought')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="emotion_after" class="block text-sm font-medium text-gray-700 mb-2">
                                ⑦ その後の気分の強さ (0-100%)
                            </label>
                            <input type="number" name="emotion_after" id="emotion_after" 
                                   value="{{ old('emotion_after', $thought->emotion_after) }}"
                                   min="0" max="100"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('emotion_after')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                更新
                            </button>
                            <a href="{{ route('thoughts.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                キャンセル
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>