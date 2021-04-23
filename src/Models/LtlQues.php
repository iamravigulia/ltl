<?php
namespace Edgewizz\Ltl\Models;

use Illuminate\Database\Eloquent\Model;

class LtlQues extends Model{
    /* public function answers(){
        return $this->hasMany('Edgewizz\Mcqanpt\Models\McqanptAns', 'question_id');
    } */
    protected $table = 'fmt_ltl_ques';
}