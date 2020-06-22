<?php

namespace App\Http\Requests;

class RefundRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'salary_paper' => ['required', 'string', 'max:100'],
            'salary_amount' => ['required', 'numeric','min:0'],
            'start_work_date' => ['date'],
            'end_work_date' => ['date'],
            'salary_paper_month' => ['required', 'string', 'max:100'],

        
            
        ];
    }

    public function messages()
    {
        return
            ['salary_paper.required' => 'هل تملك قسيمة راتب (تلوش) لفترة الاسترجاع؟',
                'salary_amount.required' => 'الرجاءإدخال آخر راتب',
                 'start_work_date.required' => 'الرجاء إدخال تاريخ',
                'end_work_date.required' => 'الرجاء إدخال تاريخ',
                'salary_paper_month.required' => 'هل حصلت على تلوش بنفس الشهر الذي حدثت به الإصابة'];


        
    }
}
