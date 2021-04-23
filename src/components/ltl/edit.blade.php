<!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@php $que = DB::table('fmt_ltl_ques')->where('id', $message)->first(); @endphp
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modalLTL{{$que->id}}">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!--
        Background overlay, show/hide based on modal state.
  
        Entering: "ease-out duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100"
          To: "opacity-0"
      -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <!--
        Modal panel, show/hide based on modal state.
  
        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
        <div class="inline-block align-bottom bg-white rounded-lg text-xs text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative -mx-8" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <a onclick="closeModalLTL({{$message}})" style="z-index: 999999999999999999999999; position: relative;" class="p-2 bg-white w-8 h-8 bg-gray-600 text-white rounded-full absolute right-0 -top-10 -mr-2 -mt-2 z-40" href="javascript:void(0);">x</a>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <form action="{{route('fmt.ltl.store')}}" method="post" enctype="multipart/form-data">
                    @if ($errors ?? '')
                        <div class="my-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <input type="text" name="question_id" value="{{$que->id}}">
                    <div class="text-xl">Edit Learn the Letter Question {{$message}}</div>
                    <div style="background: #303030; color:#fff; display:inline; cursor:grab;" onclick="closeModalLTL({{$message}})">Close Model</div>
                    <div class="flex flex-wrap -mx-4 my-2">{{-- flex-wrap --}}
                        <div class="w-full px-4">{{-- w-1/3 --}}
                            <div class="my-2">
                                <label class="bloc" for="">Format Title</label>
                                <textarea style="border: 1px solid #303030; border-radius:4px; width:100%;" name="format_title" id="" cols="30" rows="2" placeholder="Question">{{$que->format_title}}</textarea>
                            </div>
                        </div>{{-- //w-1/3 --}}

                        {{-- LETTER --}}

                        <div class="w-full px-4">{{-- w-1/3 --}}
                            <div class="my-2">
                                <label class="bloc" for="">Letter</label>
                                <input style="border: 1px solid #303030; border-radius:4px; width:100%;" name="letter" id="" cols="30" rows="4" placeholder="Letter" value="{{$que->letter}}" required>
                            </div>
                        </div>{{-- //w-1/3 --}}
                        <div class="w-full px-2">
                            @php $letter_image = DB::table('media')->where('id', $que->letter_image_media_id)->first() @endphp
                            @if($letter_image)
                            <img src="{{url('/')}}/storage/{{$letter_image->url}}" style="width:40px; height:30px; object-fit:cover;"></li>
                            @endif
                        </div>
                        <div class="w-full px-2">
                            <label class="fmt_label" for="">Letter Image</label>
                            <input class="fmt_input" style="border: 1px solid #303030; border-radius:4px; width:100%;"" type="file" accept="image/*" name="letter_image" placeholder="letter image" >
                        </div>
                        <div class="w-full px-2">
                            @php $letter_audio = DB::table('media')->where('id', $que->letter_audio_media_id)->first() @endphp
                            @if($letter_audio)
                            <audio controls="controls" src="{{url('/')}}/storage/{{$letter_audio->url}}"></audio>
                            @endif
                        </div>
                        <div class="w-full px-2">
                            <label class="fmt_label" for="">Letter Audio    </label>
                            <input class="fmt_input" style="border: 1px solid #303030; border-radius:4px; width:100%;"" type="file" accept="audio/*" name="letter_audio" placeholder="letter audio" >
                        </div>
                        <div class="w-full px-2">
                            <div>
                                <label class="fmt_label" for="">Letter Transliteration</label>
                                <input class="fmt_input" style="border: 1px solid #303030; border-radius:4px; width:100%;" type="text" name="letter_trans" placeholder="letter Transliteration" style="width: 100%;" value="{{$que->letter_trans}}">
                            </div>
                        </div>
                    {{--  // LETTER --}}
                    {{-- WORD --}}
                    <div class="w-full px-4">{{-- w-1/3 --}}
                        <div class="my-2">
                            <label class="bloc" for="">Word</label>
                            <input style="border: 1px solid #303030; border-radius:4px; width:100%;" name="word" id="" cols="30" rows="4" placeholder="Word" value="{{$que->word}}" required>
                        </div>
                    </div>{{-- //w-1/3 --}}
                    
                    <div class="w-full px-2">
                        @php $word_image = DB::table('media')->where('id', $que->word_image_media_id)->first() @endphp
                        @if($word_image)
                        <img src="{{url('/')}}/storage/{{$word_image->url}}" style="width:40px; height:30px; object-fit:cover;"></li>
                        @endif
                    </div>
                    <div class="w-full px-2">
                        <label class="fmt_label" for="">word Image</label>
                        <input class="fmt_input" style="border: 1px solid #303030; border-radius:4px; width:100%;" name="word_image" type="file" accept="image/*" name="word_image" placeholder="word image" >
                    </div>

                    <div class="w-full px-2">
                        @php $word_audio = DB::table('media')->where('id', $que->word_audio_media_id)->first() @endphp
                        @if($word_audio)
                        <audio controls="controls" src="{{url('/')}}/storage/{{$word_audio->url}}"></audio>
                        @endif
                    </div>
                    <div class="w-full px-2">
                        <label class="fmt_label" for="">word Audio</label>
                        <input class="fmt_input" style="border: 1px solid #303030; border-radius:4px; width:100%;" type="file" accept="audio/*" name="word_audio" placeholder="word audio" >
                    </div>
                    <div class="w-full px-2">
                        <label class="fmt_label" for="">word Transliteration</label>
                        <input class="fmt_input" style="border: 1px solid #303030; border-radius:4px; width:100%;" type="text" name="word_trans" placeholder="word Transliteration"  value="{{$que->word_trans}}">
                    </div>
                    
                    {{--  // WORD --}}
                    <div class="w-full my-2 px-2">
                        <label class="fmt_label" for="">meaning</label>
                        <input style="border: 1px solid #303030; border-radius:4px; width:100%;" type="text" name="meaning" placeholder="meaning" style="width: 100%;" value="{{$que->meaning}}">
                    </div>
                    <div class="w-full my-2 px-2">
                        <label class="fmt_label" for="">info</label>
                        <textarea style="border: 1px solid #303030; border-radius:4px; width:100%;" type="text" name="info" placeholder="info" style="width: 100%;">{{$que->info}}</textarea>
                    </div>
                
                    <div class="my-2 w-full px-2">
                        <label class="bloc" for="">Difficulty Level</label>
                        @php $d_levels = DB::table('difficulty_levels')->get(); @endphp
                        <select name="difficulty_level_id" id="" class="w-full my-2 px-2 py-2 border border-gray-500 rounded-lg">
                            @if ($que->difficulty_level_id)
                                @php $mylevel = DB::table('difficulty_levels')->where('id', $que->difficulty_level_id)->first(); @endphp
                                    <option value="{{$mylevel->id}}">{{$mylevel->name}}</option>
                                @foreach ($d_levels as $level)
                                    @if ($level->id == $mylevel->id)
                    
                                    @else
                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($d_levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <button class="w-full my-2 py-1 px-2 bg-blue-600 text-white rounded-lg" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
