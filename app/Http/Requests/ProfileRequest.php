<?php

namespace App\Http\Requests;

class ProfileRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'SysUsr_FullName' => ['required', 'string', 'max:100'],
            'SysUsr_DoB' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:1'],
            'city' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:100'],
            'sid' => ['required',  'numeric'],
            'social_status' => ['string',  'numeric'],
        
            
        ];
    }

    public function messages()
    {
        return
            ['SysUsr_FullName.required' => 'الرجاء تعبئة الاسم',
                'gender.required' => 'الرجاء تعبئة الجنس',
                'city.required' => 'الرجاء تعبئة المدينة',
                 'SysUsr_DoB.required' => 'الرجاء تعبئة تاريخ الميلاد',
                'address.required' => 'يجب تعبئة العنوان'
                ,'sid.required' => 'يجب تعبئة رقم الهوية'
                ,'social_status.required' => 'يجب تعبئة الحالة الإجتماعية'];

        
    }
}
