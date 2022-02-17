<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswerForm extends Model
{
    use HasFactory;

    protected $table = 'survey_answer_form';

    protected $fillable = [
        'survey_answer_id',
        'survey_form_id',
        'answer',
    ];
}
