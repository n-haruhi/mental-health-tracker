<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('薬の編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('medications.update', $medication) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('薬の名前')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $medication->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="dosage" :value="__('用量（任意）')" />
                            <x-text-input id="dosage" class="block mt-1 w-full" type="text" name="dosage" :value="old('dosage', $medication->dosage)" placeholder="例: 1錠" />
                            <x-input-error :messages="$errors->get('dosage')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('服用タイミング')" />
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="timing[]" value="morning" class="rounded" {{ in_array('morning', old('timing', $medication->timing)) ? 'checked' : '' }}>
                                    <span class="ml-2">朝</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="timing[]" value="afternoon" class="rounded" {{ in_array('afternoon', old('timing', $medication->timing)) ? 'checked' : '' }}>
                                    <span class="ml-2">昼</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="timing[]" value="evening" class="rounded" {{ in_array('evening', old('timing', $medication->timing)) ? 'checked' : '' }}>
                                    <span class="ml-2">夕</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="timing[]" value="night" class="rounded" {{ in_array('night', old('timing', $medication->timing)) ? 'checked' : '' }}>
                                    <span class="ml-2">夜</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="timing[]" value="bedtime" class="rounded" {{ in_array('bedtime', old('timing', $medication->timing)) ? 'checked' : '' }}>
                                    <span class="ml-2">就寝前</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('timing')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('メモ（任意）')" />
                            <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $medication->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="rounded" {{ old('is_active', $medication->is_active) ? 'checked' : '' }}>
                                <span class="ml-2">使用中</span>
                            </label>
                            <p class="text-sm text-gray-600 mt-1">チェックを外すと使用停止中になります</p>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <a href="{{ route('medications.index') }}" class="text-gray-600 hover:text-gray-800">
                                キャンセル
                            </a>
                            <x-primary-button>
                                {{ __('更新') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>