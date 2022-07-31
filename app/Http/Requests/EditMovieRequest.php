<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMovieRequest extends FormRequest
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
            'name' => ['required', 'string'], 
            'year_of_release' => ['required', 'date_format:Y', 'min:4'], 
            'plot' => ['required', 'string'],
            'poster' => ['sometimes', 'mimes:jpg,jpeg,png', 'max:10000']
        ];
    }
}
