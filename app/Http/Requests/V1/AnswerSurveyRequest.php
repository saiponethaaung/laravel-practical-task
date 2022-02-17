<?php

namespace App\Http\Requests\V1;

use Auth;

use App\Http\Requests\BaseRequest;

class AnswerSurveyRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $count = \App\Models\SurveyForm::where('survey_id', request()->surveyID)->count();

        return [
            'forms' => 'required|array|size:' . $count,
            'forms.*' => function ($attr, $value, $fail) {
                $form = \App\Models\SurveyForm::find($value['survey_form_id']);

                if (empty($form) || is_null($form)) {
                    $fail('Invalid form id!(' . $attr . ')');
                    return;
                }

                if (!$form->optional && empty($value['answer'])) {
                    $fail($form->name . ' cannot be empty!(' . $attr . ')');
                    return;
                }

                if ($form->type === 'range') {
                    if ($form->min > $value['answer'] || $form->max < $value['answer']) {
                        $fail($form->name . ' value is invalid!(' . $attr . ')');
                        return;
                    }
                }

                if ($form->type === 'datepicker' && ($form->min > -1 || $form->max > -1)) {
                    if (($form->min > -1 && $form->min > $value['answer']) || ($form->max > -1 && $form->max < $value['answer'])) {
                        $fail($form->name . ' value is invalid!(' . $attr . ')');
                        return;
                    }
                }

                if (in_array($form->type, ['checkbox', 'radio', 'dropdown'])) {
                    $options = json_decode($form->options, true);
                    $isValid = false;

                    foreach ($options as $option) {
                        if ($value['answer'] === $option['key']) {
                            $isValid = true;
                            break;
                        }
                    }

                    if (!$isValid) {
                        $fail($form->name . ' value is invalid!(' . $attr . ')');
                        return;
                    }
                }
            }
        ];
    }
}
