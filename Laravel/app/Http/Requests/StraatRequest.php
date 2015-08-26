<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StraatRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'straatnaam'=>'required'
        ];
        if (false)
        {
            $rules['eenAnderVeld'] = 'required';
        }
        return $rules;
    }
}
