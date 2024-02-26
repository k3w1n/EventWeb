<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'address' => 'required|max:155|min:2',
            'longtitude' => 'required',
            'latitude' => 'required',
            'image' => 'image|required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'description' => 'required',
            'tags.*' => 'required|exists:tags,id',
        ];
    }
}
