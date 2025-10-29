<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->check();
    }

    public function messages()
    {
        return [
            'profile_pic.image' => 'Profile Picture must be an image',
            'profile_pic.mimes' => 'Profile Picture must be a file of type: jpeg, png, jpg.',
            'profile_pic.max' => 'Profile Picture size must be less than 2048 kilobytes.',
            'password.confirmed' => 'Password and Confirm Password does not match.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'batch_number' => 'nullable',
            'passing_year' => 'nullable',
            'department_id' => 'nullable',
            'student_id_number' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|confirmed|min:6',
        ];
    }
}
