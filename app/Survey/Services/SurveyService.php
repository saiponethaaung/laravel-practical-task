<?php

namespace App\Survey\Services;

use Illuminate\Http\Request;

interface SurveyService
{
    function getSurvey(Request $request);

    function getSurveys(Request $request);

    function createSurvey(Request $request);

    function answerSurvey(Request $request);
}
