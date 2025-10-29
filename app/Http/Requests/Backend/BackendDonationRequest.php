<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BackendDonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return in_array(auth()->user()->role->id, [
            \App\Models\Role::ROLE_ADMIN,
            \App\Models\Role::ROLE_ALUMNI,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'amount' => 'nullable|numeric|min:0',
            'status' => 'in:active,inactive',
        ];
    }
}