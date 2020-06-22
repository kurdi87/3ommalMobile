<?php

namespace App\Http\Requests;

class DepartmentRequest  extends SuperAdminRequest
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
        'keywords' => 'required|max:1000'
        
            
        ];
    }

    public function messages()
    {
        return [
   'name' => 'required|max:20',
        'keywords' => 'required|max:200'


        ];
        
    }
}
