<?php

namespace edgewizz\ltl\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Ltl\Models\LtlQues;
use Illuminate\Http\Request;

class LtlController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
        $find_id = $request->question_id;
        if($find_id){
            $q = LtlQues::findOrFail($find_id);
        }else{
            $q = new LtlQues();
        }
        // dd($q);
        $q->letter          = $request->letter;
        /* letter_image */
        if($request->letter_image){
            $letter_image       = new Media();
            $request->letter_image->storeAs('public/ltl', time().$request->letter_image->getClientOriginalName());
            $letter_image->url  = 'ltl/'.time().$request->letter_image->getClientOriginalName();
            $letter_image->save();
            $q->letter_image_media_id          = $letter_image->id;
        }
        /* //letter_image */
        /* letter_audio */
        if($request->letter_audio){
            $letter_audio       = new Media();
            $request->letter_audio->storeAs('public/ltl', time().$request->letter_audio->getClientOriginalName());
            $letter_audio->url  = 'ltl/'.time().$request->letter_audio->getClientOriginalName();
            $letter_audio->save();
            $q->letter_audio_media_id          = $letter_audio->id;
        }
        /* //letter_audio */
        $q->letter_trans    = $request->letter_trans;

        $q->word            = $request->word;
        /* word_image */
        if($request->word_image){
            $word_image       = new Media();
            $request->word_image->storeAs('public/ltl', time().$request->word_image->getClientOriginalName());
            $word_image->url  = 'ltl/'.time().$request->word_image->getClientOriginalName();
            $word_image->save();
            $q->word_image_media_id          = $word_image->id;
        }
        /* //word_image */
        /* word_audio */
        if($request->word_audio){
            $word_audio       = new Media();
            $request->word_audio->storeAs('public/ltl', time().$request->word_audio->getClientOriginalName());
            $word_audio->url  = 'ltl/'.time().$request->word_audio->getClientOriginalName();
            $word_audio->save();
            $q->word_audio_media_id          = $word_audio->id;
        }
        /* //word_audio */
        /*  */
        $q->word_trans      = $request->word_trans;
        $q->meaning         = $request->meaning;
        $q->info            = $request->info;
        $q->difficulty_level_id            = $request->difficulty_level_id;
        $q->format_title            = $request->format_title;
        $q->save();

        if($find_id){
            return back()->with('success', 'updated succesfully');
        }else{
            if($request->problem_set_id && $request->format_type_id){
                $pbq = new ProblemSetQues();
                $pbq->problem_set_id    = $request->problem_set_id;
                $pbq->question_id       = $q->id;
                $pbq->format_type_id    = $request->format_type_id;
                $pbq->save();
            }
            return back()->with('success', 'added succesfully');
        }
    }
    /* public function inactive($id){
        $f = LtlQues::where('id', $id)->first();
        $f->active = '0';
        $f->save();
        return back();
    }
    public function active($id){
        $f = LtlQues::where('id', $id)->first();
        $f->active = '1';
        $f->save();
        return back();
    } */

    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $media = new Media();
                $valueImage->storeAs('public/question_images', time() . $valueImage->getClientOriginalName());
                $media->url = 'question_images/' . time() . $valueImage->getClientOriginalName();
                $media->save();
                return $media->id;
            }
        }
    }

    public function csv_upload(Request $request){
        $file = $request->file('file');
        $images = $request->file('images');
        $audio = $request->file('audio');
        // dd($file);
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        "letter"          => $importData[1],
                        "letter_image"    => $importData[2],
                        "letter_audio"    => $importData[3],
                        "letter_trans"    => $importData[4],

                        "word"            => $importData[5],
                        "word_image"      => $importData[6],
                        "word_audio"      => $importData[7],
                        "word_trans"      => $importData[8],

                        "meaning"         => $importData[9],
                        "info"            => $importData[10],

                        "level"           => $importData[11],

                    );
                    // var_dump($insertData['answer1']);
                    /*  */
                    if ($insertData['letter']) {
                        $fill_Q                 = new LtlQues();
                        $fill_Q->format_title   = $request->format_title;
                        if(!empty($insertData['level'])){
                            if($insertData['level'] == 'easy'){
                                $fill_Q->difficulty_level_id = 1;
                            }else if($insertData['level'] == 'medium'){
                                $fill_Q->difficulty_level_id = 2;
                            }else if($insertData['level'] == 'hard'){
                                $fill_Q->difficulty_level_id = 3;
                            }
                        }

                        $fill_Q->letter             = $insertData['letter'];
                        if (!empty($insertData['letter_image']) && $insertData['letter_image'] != '') {
                            $letter_image = $this->imagecsv($insertData['letter_image'], $images);
                            $fill_Q->letter_image_media_id = $letter_image;
                        }
                        if (!empty($insertData['letter_audio']) && $insertData['letter_audio'] != '') {
                            $letter_audio = $this->imagecsv($insertData['letter_audio'], $audio);
                            $fill_Q->letter_audio_media_id = $letter_audio;
                        }
                        $fill_Q->letter_trans       = $insertData['letter_trans'];

                        $fill_Q->word               = $insertData['word'];
                        if (!empty($insertData['word_image']) && $insertData['word_image'] != '') {
                            $word_image = $this->imagecsv($insertData['word_image'], $images);
                            $fill_Q->word_image_media_id = $word_image;
                        }
                        if (!empty($insertData['word_audio']) && $insertData['word_audio'] != '') {
                            $word_audio = $this->imagecsv($insertData['word_audio'], $audio);
                            $fill_Q->word_audio_media_id = $word_audio;
                        }
                        $fill_Q->word_trans         = $insertData['word_trans'];

                        $fill_Q->meaning            = $insertData['meaning'];
                        $fill_Q->info               = $insertData['info'];
                        $fill_Q->save();
                        
                        if($request->problem_set_id && $request->format_type_id){
                            $pbq = new ProblemSetQues();
                            $pbq->problem_set_id = $request->problem_set_id;
                            $pbq->question_id = $fill_Q->id;
                            $pbq->format_type_id = $request->format_type_id;
                            $pbq->save();
                        }
                    }
                    /*  */
                }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
        return back();
    }
}
