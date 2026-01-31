<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            心の整理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
                            </svg>
                            <h3 class="text-lg font-medium">認知行動療法による思考記録</h3>
                            <button onclick="document.getElementById('helpModal').classList.remove('hidden')" 
                                    class="ml-2 text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route('thoughts.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            作成
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($thoughts->count() > 0)
                        <div class="space-y-4">
                            @foreach ($thoughts as $thought)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 cursor-pointer relative" onclick="window.location='{{ route('thoughts.show', $thought) }}'">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-500 mb-2">{{ $thought->date->format('Y年m月d日') }}</p>
                                            
                                            @if ($thought->situation)
                                                <div class="mb-2">
                                                    <span class="text-xs font-medium text-gray-600">状況:</span>
                                                    <p class="text-sm text-gray-700">{{ Str::limit($thought->situation, 80) }}</p>
                                                </div>
                                            @endif

                                            @if ($thought->emotion)
                                                <div class="mb-2">
                                                    <span class="text-xs font-medium text-gray-600">気分:</span>
                                                    <span class="text-sm text-gray-700">{{ $thought->emotion }}</span>
                                                    @if ($thought->emotion_intensity)
                                                        <span class="text-sm text-blue-600 font-medium">({{ $thought->emotion_intensity }}%)</span>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($thought->automatic_thought)
                                                <div class="mb-2">
                                                    <span class="text-xs font-medium text-gray-600">自動思考:</span>
                                                    <p class="text-sm text-gray-700">{{ Str::limit($thought->automatic_thought, 100) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2 ml-4 items-center relative z-10" onclick="event.stopPropagation()">
                                            <a href="{{ route('thoughts.edit', $thought) }}" 
                                               class="text-blue-600 hover:text-blue-900 text-sm flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                編集
                                            </a>
                                            <form action="{{ route('thoughts.destroy', $thought) }}" method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('本当に削除しますか？');">
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
                            @endforeach
                        </div>
                    @else
                      <div class="text-center py-12">
                          <p class="text-gray-500 mb-2">まだ記録がないようです</p>
                          <p class="text-sm text-gray-400">認知行動療法の手法を使って、考えを整理してみましょう。<br>右上の「作成」ボタンから始められます。</p>
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- ヘルプモーダル -->
<div id="helpModal" class="hidden fixed inset-0 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4" style="background-color: rgba(0, 0, 0, 0.75);" onclick="if(event.target === this) this.classList.add('hidden')">
    <div class="relative bg-white rounded-lg shadow-xl max-w-md" onclick="event.stopPropagation()">
        <!-- ヘッダー -->
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-xl font-bold text-gray-900">心の整理とは？</h3>
            <button onclick="document.getElementById('helpModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- コンテンツ -->
        <div class="p-6 space-y-4 text-gray-700">
            <p>
                <strong>認知行動療法の「7つのコラム法」</strong>を使った思考記録です。<br>
                気分が落ち込んだり、不安になったときの考えを整理することで、より現実的でバランスの取れた見方を見つけることができます。
            </p>

            <p>
                人それぞれの感じ方や状況があります。<br>
                もし記録しても変化を感じられなくても、自分を責める必要はありません。気楽に、書ける範囲で記録を続けてみてください。
            </p>
            
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="font-medium mb-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    記録の効果
                </h4>
                <ul class="space-y-1 text-sm" style="list-style-type: disc; padding-left: 1.5rem;">
                    <li>自分の考え方のクセに気づける</li>
                    <li>感情を客観的に見られるようになる</li>
                    <li>別の視点を持てるようになる</li>
                    <li>気持ちが軽くなる</li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="font-medium mb-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    書き方のコツ
                </h4>
                <ul class="space-y-1 text-sm" style="list-style-type: disc; padding-left: 1.5rem;">
                    <li>全ての項目を埋める必要はありません</li>
                    <li>気持ちが動いた場面を選んで記録しましょう</li>
                    <li>完璧じゃなくて大丈夫、思いついたことを自由に書いてみましょう</li>
                    <li>継続することで、徐々に効果を実感できます</li>
                </ul>
            </div>
            
            <p class="text-sm text-gray-600">
                ※この機能は自分の気持ちや状態への理解を深め、セルフケアをサポートするためのツールです。<br>
                あまりにつらく耐え難いときは一人で抱え込まず、信頼できる人や専門家に相談することも検討してください。
            </p>
        </div>
    </div>
</div>