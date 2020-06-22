<?php

namespace App\Http\Requests;

class MenuRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
        'title' => 'required|max:50',
        'action' => 'required',
        'm_order' => 'required',
        
            
        ];
    }

    public function messages()
    {
        return [
          'title' => 'required|max:50',
        'action' => 'required',
        'm_order' => 'required',
           
        ];
    }
  
}
