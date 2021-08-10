<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=> 'required',
            'subtitle'=> 'required',
            'description' => 'required',
            'status'=> 'required|digits_between:1,3',
            'estimated_completion_time'=> 'required',
            'category_id'=>'required'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'subtitle.required' => 'Subtitle is required!',
            'description.required' => 'Description is required!',
            'status.required' => 'Status is required!',
            'estimated_completion_time.required' => 'Estimeted completion time is required!',
            'category_id'=>'To do category is required',
            'status.digits_between' => 'Invalid status'

        ];
    }
}