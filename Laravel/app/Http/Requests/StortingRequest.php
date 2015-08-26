<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StortingRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Since this requist could be used by different
        // methods, the rules could be adjusted using
        // if clauses.
        $rules = [
            'omschrijving'=>'required'
            ];
        //'prijs'=>'required'
        //'datum'=>'required',
        //'maaltijd'=>'required'
        if (false)
        {
            $rules['eenAnderVeld'] = 'required';
        }
        return $rules;
    }
}
