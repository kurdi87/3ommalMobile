<?php

namespace App\Http\Requests;

class SpecialityRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'special' => 'required|max:200',

        
            
        ];
    }

    public function messages()
    {
        return [
   'special' => 'required|max:20',
      


        ];
        
    }
}
