<?php

namespace App\Survey\ServicesImpl;

use App\Survey\Repositories\SurveyRepository;
use App\Survey\Services\SurveyService;
use Illuminate\Http\Request;

class SurveyServiceImpl implements SurveyService
{
    private $repo;

    public function __construct(SurveyRepository $repo)
    {
        $this->repo = $repo;
    }

    function getSurvey(Request $request)
    {
        $survey = $this->repo->getOne($request->surveyID);

        $forms = [];

        foreach ($survey->forms as $form) {
            $forms[] = [
                'id' => (int) $form->id,
                'name' => (string) $form->name,
                'type' => (string) $form->type,
                'min' => (string) $form->min,
                'max' => (string) $form->max,
                'values' => (string) $form->values,
                'max_size' => (int) $form->max_size,
                'char_count' => (int) $form->char_count,
                'options' => json_decode($form->options, true),
                'optional' => (bool) $form->optional,
            ];
        }

        return [
            'status' => true,
            'code' => 200,
            'data' => [
                'info' => [
                    'name' => $survey->name,
                    'forms' => $forms
                ],
            ],
            'msg' =>  'Success.',
        ];
    }

    function getSurveys(Request $request)
    {
        $list = $this->repo->getAll();
        $res = [];

        foreach ($list as $l) {
            $res[] = [
                'id' => (int) $l->id,
                'name' => (string) $l->name,
            ];
        }

        return [
            'status' => true,
            'code' => 200,
            'data' => [
                'list' => $res,
                'pagination' => [
                    'from' => (int) $list->firstItem(),
                    'to' => (int) $list->lastItem(),
                    'total' => (int) $list->total(),
                    'current' => (int) $list->currentPage(),
                    'last' => (int) $list->lastPage(),
                    'hasNext' => (bool) $list->hasMorePages(),
                ],
            ],
            'msg' => 'Success.',
        ];
    }

    function createSurvey(Request $request)
    {
        $input = $request->only('info', 'forms');
        $input['info']['user_id'] = $request->user()->id;

        return $this->repo->create($input);
    }

    function answerSurvey(Request $request)
    {
        $input = $request->only('forms');
        $input['info'] = [
            'survey_id' => $request->surveyID,
            'user_id' => $request->user()->id,
        ];

        return $this->repo->addAnswer($request->surveyID, $input);
    }
}
