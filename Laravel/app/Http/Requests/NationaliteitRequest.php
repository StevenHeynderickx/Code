<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NationaliteitRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'omschrijving'=>'required'
        ];
        if (false)
        {
            $rules['eenAnderVeld'] = 'required';
        }
        return $rules;
    }
}
