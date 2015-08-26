<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class JongereRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules() {
        // Since this requist could be used by different
        // methods, the rules could be adjusted using
        // if clauses.
        $rules = [
            'naam'=>'required|min:2',
            'voornaam'=>'required|min:2',
            'geboortedatum'=>'required'
        ];
        if (false)
        {
          $rules['eenAnderVeld'] = 'required';
        }
        return $rules;
    }
}
