<?php

namespace App\Survey\RepositoriesImpl;

use DB;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyAnswerForm;
use App\Models\SurveyForm;
use App\Survey\Repositories\SurveyRepository;

class SurveyRepositoryImpl implements SurveyRepository
{
    public function getOne($id)
    {
        return Survey::with('forms')->find($id);
    }

    public function getAll()
    {
        return Survey::paginate(20);
    }

    public function create($input)
    {
        $res = [
            'status' => true,
            'msg' => 'Success',
            'code' => 201,
            'data' => [],
        ];

        DB::beginTransaction();

        try {
            $survey = Survey::create($input['info']);

            foreach ($input['forms'] as $form) {
                $form['survey_id'] = $survey->id;
                if (empty($form['options'])) {
                    $form['options'] = [];
                }
                $form['options'] = json_encode($form['options']);
                SurveyForm::create($form);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $res['status'] = 'false';
            $res['code'] = 422;
            $res['msg'] = 'Failed to create survey form!';

            if (config('app.debug')) {
                $res['error']['msg'] = $e->getMessage();
                $res['error']['stack'] = $e->getTrace();
            }

            return $res;
        }

        DB::commit();

        return $res;
    }

    public function addAnswer($id, $input)
    {
        $res = [
            'status' => true,
            'msg' => 'Success',
            'code' => 201,
            'data' => [],
        ];

        DB::beginTransaction();

        try {
            $survey = SurveyAnswer::create($input['info']);

            foreach ($input['forms'] as $form) {
                $form['survey_answer_id'] = $survey->id;
                SurveyAnswerForm::create($form);
            }
            $res['data']['answer'] = $survey->id;
        } catch (\Exception $e) {
            DB::rollback();
            $res['status'] = 'false';
            $res['code'] = 422;
            $res['msg'] = 'Failed to save survey answer!';

            if (config('app.debug')) {
                $res['error']['msg'] = $e->getMessage();
                $res['error']['stack'] = $e->getTrace();
            }

            return $res;
        }

        DB::commit();

        return $res;
    }
}
