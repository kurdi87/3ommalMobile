<?php

namespace App\Http\Requests;

class CaseManagerRequest extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
            'name'=>'required |max:100',









        ];
    }

    public function messages()
    {
        return [
            'name'=>'required |max:100',





        ];
    }
  
}
