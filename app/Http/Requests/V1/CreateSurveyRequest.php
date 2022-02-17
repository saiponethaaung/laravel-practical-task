<?php

namespace App\Http\Requests\V1;

use Auth;

use App\Http\Requests\BaseRequest;

class CreateSurveyRequest extends BaseRequest
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
        return [
            'info.name' => 'required',
            'forms' => 'required|array|min:1',
            'forms.*.name' => 'required|distinct',
            'forms.*.type' => 'required|in:text,string,datepicker,checkbox,radio,dropdown,file,range',
            'forms.*.min' => 'nullable',
            'forms.*.max' => 'nullable',
            'forms.*.max_size' => 'nullable|numeric',
            'forms.*.char_count' => 'nullable',
            'forms.*.options' => 'nullable|array',
            'forms.*.optional' => 'boolean',
            'forms.*.multiple' => 'boolean',
            'forms.*' => function ($attr, $value, $fail) {
                if ($value['type'] === 'range') {
                    if (empty($value['min']) || empty($value['max'])) {
                        $fail('Min and max value is required for range type. (' . $attr . ')');
                    }
                }

                if (in_array($value['type'], ['datepicker', 'range'])) {
                    if ($value['min'] > $value['max']) {
                        $fail('Min cannot be bigger than max. (' . $attr . ')');
                    }
                }

                if (in_array($value['type'], ['checkbox', 'radio', 'dropdown'])) {
                    if (empty($value['options']) || !is_array($value['options'])) {
                        $fail('Options is required for checkbox,radio and dropdown. (' . $attr . ')');
                    }

                    foreach ($value['options'] as $v) {
                        if (empty($v['key']) || empty($v['value'])) {
                            $fail('Options need to be array with key and value({key: key, value: value}). (' . $attr . ')');
                        }
                    }
                }
            }
        ];
    }
}
