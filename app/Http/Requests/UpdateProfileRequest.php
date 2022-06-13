<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email,'.$this->id],
            'position' => ['required', 'string', 'max:255'],
            'position_en' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'mobile' => ['required', 'string', 'max:20'],
            'wechat' => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'alpha_num'],
            'current_password' => ['nullable', 'current_password', 'required_with:password'],
            'password' => ['confirmed', 'different:current_password', 'nullable', 'required_with:current_password']
        ];
    }
}
