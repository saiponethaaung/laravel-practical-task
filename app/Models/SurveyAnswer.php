<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;

    protected $table = 'survey_answer';

    protected $fillable = [
        'survey_id',
        'user_id',
    ];

    public function survey()
    {
        return $this->belongsTo('App\Models\Survey');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\SurveyAnswerForm');
    }
}
