<?php

namespace App\Http\Requests;

class PasswordRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'password' => ['required', 'string', 'min:6'],

        
            
        ];
    }

    public function messages()
    {
        return [

            'password' => 'Please Fill Password 6 Characters',
      


        ];
        
    }
}
