<?php

namespace App\Http\Requests;

class PatientRequest extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules()
    {
        return [
            'fname_ar' => 'required |max:100',

            'faname_ar' => 'required |max:100',
            'fname' => 'required |max:100',
            'city' => 'required |max:100',
            'faname' => 'required |max:100',
            'sid' => 'required |max:9|unique:patient,sid,' . $this->segment(4),


        ];
    }

    public function messages()
    {
        return [
            'sid.unique' => 'Patient Document No is Taken',

            'city' => 'required |max:100',
            'sid' => 'required |max:9|unique:patient,sid,' . $this->segment(4),



        ];
    }

}
