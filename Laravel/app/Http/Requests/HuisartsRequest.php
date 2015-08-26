<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HuisartsRequest extends Request
{
    public function authorize()
    {
        return  true;
    }
    public function rules()
    {
        // Since this requist could be used by different
        // methods, the rules could be adjusted using
        // if clauses.
        $rules = [
            'naam'          =>'required',
            'voornaam'      =>'required',
            'contactnummer' =>'required',
            'straat_entry'  =>'required|min:2',
            'nummer'        =>'required',
            'gemeente_entry'=>'required'

        ];
        if (false)
        {
            $rules['eenAnderVeld'] = 'required';
        }
        return $rules;
   }
}
