<?php

namespace App\Http\Requests;

class RoleRequest extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "Role_Name" => "required|unique:Role,Role_Name," . $this->segment(4) . ',Role_ID',
            "action" => "array|required"
        ];
    }

    public function messages()
    {
        return [
            "array" => "Check at least on permission",
            'action.required' => 'At least add one permission!'
        ];
    }
}
