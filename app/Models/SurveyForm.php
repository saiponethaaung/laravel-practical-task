<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyForm extends Model
{
    use HasFactory;

    protected $table = 'survey_form';

    protected $fillable = [
        'survey_id',
        'name',
        'type',
        'min',
        'max',
        'values',
        'max_size',
        'char_count',
        'options',
        'optional',
        'multiple',
    ];
}
