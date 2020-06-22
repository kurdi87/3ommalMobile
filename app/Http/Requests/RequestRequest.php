<?php

namespace App\Http\Requests;

class RequestRequest extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
        'phone' => 'required|max:50',
        'message' => 'required',
        'email' => 'required',

            
        ];
    }

    public function messages()
    {
        return [
              'phone' => 'required|max:50',
        'message' => 'required',
        'email' => 'required',

           
        ];
    }
  
}
