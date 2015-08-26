<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GemeenteRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'gemeente'=>'required',
            'postcode'=>'required',
        ];
        if (false)
        {
            $rules['eenAnderVeld'] = 'required';
        }
        return $rules;
    }
}
