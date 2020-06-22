<?php

namespace App\Http\Requests;

class JobsRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_title' => 'required|max:500',

        
            
        ];
    }

    public function messages()
    {
        return [
   'job_title' => 'required|max:1000',
      


        ];
        
    }
}
