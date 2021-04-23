<div>
    <style>
        .fmt_box{
            margin: 10px 20px;
            padding: 10px 20px;
            border: 4px solid #eeeeee;
            background: #fff;
            box-shadow: 2px 4px 8px #b1b1b1;
        }
        .fmt_headline{
            font-size: 20px;
            margin:10px 0;
        }
        .fmt_label{
            font-size: 14px;
        }
        .fmt_input{
            padding:4px 10px;
            margin: 0 20px 0 0;
            border:1px solid #707070;
            border-radius: 4px;
            display: block;
            font-size: 16px;
        }
        .fmt_sub_btn{
            padding:6px 20px;
            margin:10px 0;
            border-radius: 8px;
            background:#0047d4;
            color:#fff;
            border:none;
            letter-spacing: 1px;
            cursor: pointer;
        }
        .fmt_checkbox{
            /* margin-left: 10px; */
            width: 34px;
            height: 34px;
            display: block;
        }
        .fmt_flex{
            display: flex;
            margin: 10px 0;
        }
        #addOption{
            padding: 6px 20px;
            background: #049e04;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <form action="{{route('fmt.ltl.store')}}" method="post" class="fmt_box" enctype="multipart/form-data">
        <input type="integer" name="problem_set_id" value="{{$pbs72 ?? ''}}" hidden style="border:1px solid #000000;">
        <input type="integer" name="format_type_id" value="{{$fmt72 ?? ''}}" hidden style="border:1px solid #000000;">
        <div class="fmt_headline">Add a Learn the Letter</div>
        <div>
            <label class="fmt_label" for="">Format Title</label>
            <input class="fmt_input" type="text" name="format_title" placeholder="format_title" style="width: 100%;">
        </div>
        {{-- letter --}}
        <div>
            <label class="fmt_label" for="">Letter</label>
            <input class="fmt_input" type="text" name="letter" placeholder="letter" style="width: 100%;" required>
        </div>
        <div>
            <label class="fmt_label" for="">Letter Image</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="image/*" name="letter_image" placeholder="letter image">
        </div>
        <div>
            <label class="fmt_label" for="">Letter audio</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="audio/*" name="letter_audio" placeholder="letter audio" >
        </div>
        <div>
            <label class="fmt_label" for="">Letter Transliteration</label>
            <input class="fmt_input" type="text" name="letter_trans" placeholder="letter Transliteration" style="width: 100%;">
        </div>
        {{-- // letter --}}
        {{-- word --}}
        <div>
            <label class="fmt_label" for="">word</label>
            <input class="fmt_input" type="text" name="word" placeholder="word" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">word Image</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="image/*" name="word_image" placeholder="word image" >
        </div>
        <div>
            <label class="fmt_label" for="">word audio</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="audio/*" name="word_audio" placeholder="word audio" >
        </div>
        <div>
            <label class="fmt_label" for="">word Transliteration</label>
            <input class="fmt_input" type="text" name="word_trans" placeholder="word Transliteration" style="width: 100%;">
        </div>
        {{-- // word --}}
        <div>
            <label class="fmt_label" for="">meaning</label>
            <input class="fmt_input" type="text" name="meaning" placeholder="meaning" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">info</label>
            <textarea class="fmt_input" type="text" name="info" placeholder="info" style="width: 100%;"></textarea>
        </div>
        <div class="my-2" style="margin: 20px 0;">
            <label class="bloc" for="">Difficulty Level</label>
            <select name="difficulty_level_id" id="" class="w-full my-2 px-2 py-2 border border-gray-500 rounded-lg">
                <option value="1">Easy</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select>
        </div>
        <hr>
        
        <div>
            <input type="submit" class="fmt_sub_btn" value="Submit">
        </div>
    </form>
    {{-- <button id="addOption">Add option</button> --}}
    {{--  --}}
    <form action="{{route('fmt.ltl.csv')}}" method="POST" enctype='multipart/form-data' style="margin:20px 40px;">
        @csrf
        <input type="integer" name="problem_set_id" value="{{$pbs72 ?? ''}}" hidden style="border:1px solid #000000;">
        <input type="integer" name="format_type_id" value="{{$fmt72 ?? ''}}" hidden style="border:1px solid #000000;">
        <div style="display:block; padding:10px;">
            <label style="font-size:12px;">Format Title</label>
            <input class="fmt_input" type="text" name="format_title" placeholder="format_title">
        </div>
        <div style="display:block; padding:10px;">
            <div style="font-size:12px;">CSV</div>
            <input style="display:block;" type="file" name="file" >
        </div>
        <div style="display:block; padding:10px;">
            <div style="font-size:12px;">Images</div>
            <input style="display:block;" type="file" name="images[]" multiple accept="image/*" placeholder="image" required>
        </div>
        <div style="display:block; padding:10px;">
            <div style="font-size:12px;">Audio</div>
            <input style="display:block;" type="file" name="audio[]" multiple accept="audio/*" placeholder="audio" required>
        </div>
        <button type="submit" style="display: inline-block; margin:10px; padding:4px 20px; background:green; color:#fff; text-transform:uppercase; border-radius:4px;">submit</button>
    </form>
    {{--  --}}
</div>
{{-- <script>
    var addOption = document.getElementById('addOption');

</script> --}}
