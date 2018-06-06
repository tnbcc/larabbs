<?php

namespace App\Http\Requests;

class StudentRequest extends Request
{
  
    public function rules()
    {
        return [
                    'name'       => 'required|min:2|max:20',
                    'sex'        => 'required|Integer',
                    'age' =>'required|Integer',
        ];
    }
}
