<?php

namespace App\Http\Requests;

class Request_to_callRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [


           // 'patient_id'=>'required',

            /*
            'coverage_type'=>'required',
            'referral_type'=>'required',
            'service_type'=>'required',
            'coverage_no'=>'required',
            'coverage_date'=>'required',
            'coverage_cost'=>'required',
            'notes'=>'required',
            'insurance_type'=>'required',
            'insurance_no'=>'required',
            'insurance_date'=>'required',
            'insurance_edate'=>'required',
            'insurance_exdate'=>'required',
            'insurance_cov'=>'required',
            'insurance_status'=>'required',*/




        ];
    }

    public function messages()
    {
        return [


            //'patient_id'=>'required',

       
        
        ];
        
    }
}
