<?php

namespace App\Http\Requests;

class InjuryRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'work_paper' => ['required', 'string', 'max:100'],
            'work_with' => ['required', 'numeric','max:100'],
            'injury_date' => ['required','date'],


        
            
        ];
    }

    public function messages()
    {
        return
            ['work_paper.required' => 'هل حصلت على تلوش بنفس الشهر الذي حدثت به الإصابة',
                'work_with.required' => 'هل كنت تعمل عند نفس المشغل المذكور بالتصريح؟',
                'injury_date.required' => 'الرجاء إدخال تاريخ',
                'injury_date.date' => 'الرجاء إدخال تاريخ'];



        
    }
}
