<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BackendEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'start_at.required' => 'Start date is required',
            'end_at.required' => 'End date is required',
            'location.required' => 'Location is required',
            'event_type_id.required' => 'Event type is required',
            'end_at.after_or_equal' => 'End date must be after or equal to start date',
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
            'title' => 'required',
            'description' => 'nullable',
            'start_at' => 'required',
            'end_at' => ['required','after_or_equal:start_at'],
            'location' => 'required',
            'event_type_id' => 'required',
        ];
    }
}
