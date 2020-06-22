<?php

namespace App\Http\Requests;

class DoctorRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name' => 'required|max:500',
        'cv' => 'required',
        
           
        ];
    }

    public function messages()
    {
        return [
        'name' => 'required|max:100',
        'cv' => 'required',
       
        
        ];
        
    }
}
