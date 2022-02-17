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
            'form' => 'required|array|min:1',
            'form.*.name' => 'required|distinct',
            'form.*.type' => 'required|in:text,string,datepicker,checkbox,radio,dropdown,file,range',
            'form.*.min' => 'nullable',
            'form.*.max' => 'nullable',
            'form.*.max_size' => 'nullable|numeric',
            'form.*.char_count' => 'nullable',
            'form.*.options' => 'nullable|array',
            'form.*.optional' => 'boolean',
            'form.*.multiple' => 'boolean',
            'form.*' => function ($attr, $value, $fail) {
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
