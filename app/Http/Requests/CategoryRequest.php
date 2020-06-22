<?php

namespace App\Http\Requests;

class CategoryRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
        'name' => 'required|max:500',

        'd_order' => 'required',
        
        
            
        ];
    }

    public function messages()
    {
        return [
        'name' => 'required|max:20',
        'd_order' => 'required',

           
        ];
    }
  
}
