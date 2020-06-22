<?php

namespace App\Http\Requests;

class TypesRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|max:200',

        
            
        ];
    }

    public function messages()
    {
        return [
   'type' => 'required|max:20',
      


        ];
        
    }
}
