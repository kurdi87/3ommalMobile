<?php

namespace App\Http\Requests;

class Question_answerRequest  extends SuperAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question_answer_text' => 'required|max:1000',

        
            
        ];
    }

    public function messages()
    {
        return [
   'question_answer_text' => 'required|max:1000',
      


        ];
        
    }
}
