<?php

namespace App\Http\Requests;

class Hr_departmentRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:200',

        
            
        ];
    }

    public function messages()
    {
        return [
   'name' => 'required|max:20',



        ];
        
    }
}
