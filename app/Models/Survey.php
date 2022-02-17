<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function forms()
    {
        return $this->hasMany('App\Models\SurveyForm');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
