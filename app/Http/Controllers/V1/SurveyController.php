<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AnswerSurveyRequest;
use App\Http\Requests\V1\CreateSurveyRequest;
use App\Survey\Services\SurveyService;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    private $service;

    public function __construct(SurveyService $service)
    {
        $this->service = $service;
    }

    public function getSurveys(Request $request)
    {
        $surveys = $this->service->getSurveys($request);
        return response()->json($surveys, $surveys['code']);
    }

    public function getSurvey(Request $request)
    {
        $survey = $this->service->getSurvey($request);
        return response()->json($survey, $survey['code']);
    }

    public function createSurvey(CreateSurveyRequest $request)
    {
        $createSurvey = $this->service->createSurvey($request);
        return response()->json($createSurvey, $createSurvey['code']);
    }

    public function answerSurvey(AnswerSurveyRequest $request)
    {
        $answerSurvey = $this->service->answerSurvey($request);
        return response()->json($answerSurvey, $answerSurvey['code']);
    }
}
