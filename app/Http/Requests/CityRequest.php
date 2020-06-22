<?php

namespace App\Http\Requests;

class CityRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name_en' => 'required|max:200',
            'name_ar' => 'required|max:200',

           
        ];
    }

    public function messages()
    {
        return [

            'name_en' => 'required|max:200',
            'name_ar' => 'required|max:200',
        
        ];
        
    }
}
