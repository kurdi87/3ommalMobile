<?php

namespace App\Http\Requests;

class VerificationRequest extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'user_id' => 'required',
            'verification_key' => 'required|min:6',

        ];
    }

    public function messages()
    {
        return
            ['user_id.required' => 'الرجاء رقم الحساب',
                'verification_key.required' => 'الرجاء رقم الحساب',
                'verification_key.min' => 'يجب أن يحتوي 6 أرقام'];


    }
}
