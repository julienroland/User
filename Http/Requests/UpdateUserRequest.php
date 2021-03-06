<?php namespace User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $userId = $this->route()->getParameter('users');
        return [
            'email' => "required|email|unique:users,email,{$userId}",
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
