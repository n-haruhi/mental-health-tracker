<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記録編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('records.update', $record) }}" method="POST" x-data="medicationForm(@js($record->medicationLogs->map(fn($log) => [
                        'type' => $log->medication_id ? 'registered' : 'other',
                        'medication_id' => $log->medication_id,
                        'medication_name' => $log->medication_name,
                        'timing' => $log->timing,
                        'taken' => $log->taken,
                        'timings' => $log->medication?->timing ?? [],
                        'taken_timings' => []
                    ])))">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                記録日 <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="date" 
                                   value="{{ old('date', $record->date->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   required>
                            @error('date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="mood_score" class="block text-sm font-medium text-gray-700 mb-2">
                                気分スコア (1-10)
                            </label>
                            <input type="number" name="mood_score" id="mood_score" 
                                   value="{{ old('mood_score', $record->mood_score) }}"
                                   min="1" max="10"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('mood_score')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="sleep_hours" class="block text-sm font-medium text-gray-700 mb-2">
                                睡眠時間（時間）
                            </label>
                            <input type="number" name="sleep_hours" id="sleep_hours" 
                                   value="{{ old('sleep_hours', $record->sleep_hours) }}"
                                   min="0" max="24" step="0.5"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('sleep_hours')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 服薬記録セクション -->
                        <div class="mb-6 border-t pt-4">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    服薬記録
                                </label>
                                <button type="button" @click="addMedication()" 
                                        class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-1 px-3 rounded inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    服薬を追加
                                </button>
                            </div>

                            <div x-show="medications.length === 0" class="text-gray-500 text-sm text-center py-4">
                                服薬記録がありません
                            </div>

                            <div class="space-y-3">
                                <template x-for="(med, index) in medications" :key="index">
                                    <div class="border rounded-lg p-4 bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="flex-1">
                                                <select x-model="med.type" @change="updateMedication(index)" class="text-sm rounded border-gray-300 mb-2">
                                                    <option value="registered">登録済みの薬</option>
                                                    <option value="other">その他の薬</option>
                                                </select>

                                                <div x-show="med.type === 'registered'">
                                                    <select x-model="med.medication_id" @change="loadMedicationTimings(index)" class="block w-full rounded border-gray-300 text-sm">
                                                        <option value="">薬を選択</option>
                                                        @foreach($medications as $medication)
                                                            <option value="{{ $medication->id }}" data-timings='@json($medication->timing)'>
                                                                {{ $medication->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div x-show="med.type === 'other'">
                                                    <input type="text" x-model="med.medication_name" placeholder="薬の名前" class="block w-full rounded border-gray-300 text-sm mb-2">
                                                    <select x-model="med.timing" class="block w-full rounded border-gray-300 text-sm">
                                                        <option value="morning">朝</option>
                                                        <option value="afternoon">昼</option>
                                                        <option value="evening">夕</option>
                                                        <option value="night">夜</option>
                                                        <option value="bedtime">就寝前</option>
                                                        <option value="as_needed">頓服</option>
                                                    </select>
                                                </div>

                                                <div x-show="med.timings && med.timings.length > 0" class="mt-3 space-y-1">
                                                    <template x-for="timing in med.timings" :key="timing">
                                                        <label class="flex items-center">
                                                            <input type="checkbox" :checked="med.taken_timings.includes(timing)" 
                                                                   @change="toggleTiming(index, timing)" class="rounded text-blue-600">
                                                            <span class="ml-2 text-sm" x-text="getTimingLabel(timing)"></span>
                                                        </label>
                                                    </template>
                                                </div>

                                                <div x-show="med.type === 'other' || (med.timings && med.timings.length === 0)" class="mt-3">
                                                    <label class="flex items-center">
                                                        <input type="checkbox" x-model="med.taken" class="rounded text-blue-600">
                                                        <span class="ml-2 text-sm">服用した</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="button" @click="removeMedication(index)" class="text-red-600 hover:text-red-800 text-sm ml-2">
                                                削除
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Hidden inputs for form submission -->
                            <template x-for="(med, index) in getMedicationLogs()" :key="index">
                                <div>
                                    <input type="hidden" :name="`medication_logs[${index}][medication_id]`" :value="med.medication_id">
                                    <input type="hidden" :name="`medication_logs[${index}][medication_name]`" :value="med.medication_name">
                                    <input type="hidden" :name="`medication_logs[${index}][timing]`" :value="med.timing">
                                    <input type="hidden" :name="`medication_logs[${index}][taken]`" :value="med.taken ? 1 : 0">
                                </div>
                            </template>
                        </div>

                        <div class="mb-6">
                            <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                                メモ
                            </label>
                            <textarea name="note" id="note" rows="6"
                                    placeholder="今日の出来事、気持ちなど、自由に書いてみましょう"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('note', $record->note) }}</textarea>
                            @error('note')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                更新
                            </button>
                            <a href="{{ route('records.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                キャンセル
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function medicationForm(existingLogs = []) {
            return {
                medications: existingLogs.map(log => ({
                    type: log.type,
                    medication_id: log.medication_id || '',
                    medication_name: log.medication_name || '',
                    timing: log.timing,
                    timings: log.timings || [],
                    taken_timings: log.taken ? [log.timing] : [],
                    taken: log.taken || false
                })),
                
                addMedication() {
                    this.medications.push({
                        type: 'registered',
                        medication_id: '',
                        medication_name: '',
                        timing: 'morning',
                        timings: [],
                        taken_timings: [],
                        taken: false
                    });
                },
                
                removeMedication(index) {
                    this.medications.splice(index, 1);
                },
                
                updateMedication(index) {
                    this.medications[index].medication_id = '';
                    this.medications[index].medication_name = '';
                    this.medications[index].timings = [];
                    this.medications[index].taken_timings = [];
                },
                
                loadMedicationTimings(index) {
                    const select = event.target;
                    const option = select.options[select.selectedIndex];
                    const timings = option.dataset.timings ? JSON.parse(option.dataset.timings) : [];
                    this.medications[index].timings = timings;
                    this.medications[index].taken_timings = [];
                },
                
                toggleTiming(medIndex, timing) {
                    const index = this.medications[medIndex].taken_timings.indexOf(timing);
                    if (index > -1) {
                        this.medications[medIndex].taken_timings.splice(index, 1);
                    } else {
                        this.medications[medIndex].taken_timings.push(timing);
                    }
                },
                
                getTimingLabel(timing) {
                    const labels = {
                        'morning': '朝',
                        'afternoon': '昼',
                        'evening': '夕',
                        'night': '夜',
                        'bedtime': '就寝前',
                        'as_needed': '頓服'
                    };
                    return labels[timing] || timing;
                },
                
                getMedicationLogs() {
                    const logs = [];
                    this.medications.forEach(med => {
                        if (med.type === 'registered' && med.medication_id) {
                            if (med.taken_timings.length > 0) {
                                med.taken_timings.forEach(timing => {
                                    logs.push({
                                        medication_id: med.medication_id,
                                        medication_name: null,
                                        timing: timing,
                                        taken: true
                                    });
                                });
                            }
                        } else if (med.type === 'other' && med.medication_name) {
                            logs.push({
                                medication_id: null,
                                medication_name: med.medication_name,
                                timing: med.timing,
                                taken: med.taken
                            });
                        }
                    });
                    return logs;
                }
            }
        }
    </script>
</x-app-layout>