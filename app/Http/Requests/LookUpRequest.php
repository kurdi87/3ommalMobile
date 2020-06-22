<?php

namespace App\Http\Requests;

class LookUpRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lookUp' => 'required|max:200',

        
            
        ];
    }

    public function messages()
    {
        return [
   'lookUp' => 'required|max:20',
      


        ];
        
    }
}
