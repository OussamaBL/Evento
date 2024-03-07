<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'place' => 'required|string',
            'title' => 'required|string',
            'price' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'acceptance' => 'required|in:auto,manual',
            'nbr_place' => 'required|integer',
            'date_event' => 'required|date|after_or_equal:today',
            
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'place.required' => 'The place field is required.',
            'place.string' => 'The place must be a string.',

            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',

            'price.required' => 'The price field is required.',
            'price.integer' => 'The price must be an integer.',

            'duration.required' => 'The duration field is required.',
            'duration.integer' => 'The duration must be an integer.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            
            'acceptance.required' => 'The acceptance field is required.',
            'acceptance.in' => 'The acceptance must be either "auto" or "manual".',

            'nbr_place.required' => 'The capacity field is required.',
            'nbr_place.integer' => 'The capacity must be an integer.',

            'date_event.required' => 'The date field is required.',
            'date_event.date' => 'The date must be a valid date.',

            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',


            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image must not be larger than 2048 kilobytes.',
        ];
    }
}
