<?php

namespace App\Http\Requests;

class RegisterRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'SysUsr_Mobile'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        
            
        ];
    }

    public function messages()
    {
        return
            ['SysUsr_Mobile.required' => 'الرجاء تعبئة الهاتف','SysUsr_Mobile.regex' => 'الرجاء تعبئة رقم صحيح','SysUsr_Mobile.unique' => 'تم التسجيل مسبقا'
                ,'SysUsr_Mobile.min' => 'يجب أن يحتوي 9 أرقام'];



        
    }
}
