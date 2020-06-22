<?php

namespace App\Http\Requests;

class AccidentRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [


            'driver_sid'=>'max:12|regex:/^[0-9]+$/',
            'note_id'=>'max:12|regex:/^[0-9]+$/',
            'city'=>'required|not_in:0',
            'people'=>'required',
            'hospital_id'=>'required|not_in:0',
            'accident_validity'=>'required|not_in:0'


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

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('police_detective', 'not_in:0', function($input) {
            return $input->type== 156;
        });
        $validator->sometimes('driver_city', 'not_in:0', function($input) {
            return $input->type== 156;
        });

        $validator->sometimes('driver_dob', 'not_in:0', function($input) {
            return $input->type== 156;
        });

        $validator->sometimes('driver_license', 'not_in:0', function($input) {
            return $input->type== 156;
        });

        return $validator;
    }

    public function messages()
    {
        return [
            'driver_sid'=>'max:12|regex:/^[0-9]+$/',
            'note_id'=>'max:12|regex:/^[0-9]+$/',
            'city'=>'required|not_in:0',
            'people'=>'required',
            'hospital_id'=>'required|not_in:0',
            'driver_city'=>'required_if:type,156|not_in:0',
            'accident_validity'=>'required|not_in:0',
            'driver_city'=>'required_if:type,156|not_in:0 ',
            'driver_dob'=>'required_if:type,156|not_in:0 ',
            'driver_license'=>'required_if:type,156|not_in:0 ',

       
        
        ];
        
    }
}
