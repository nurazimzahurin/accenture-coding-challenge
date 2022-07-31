<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteMovieCelebrityRequest extends FormRequest
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
            'movie_id' => ['required', 'int', 'exists:movies,id'],
            'celebrity_id' => ['required', 'int', 'exists:celebrities,id'],
            'role' => ['required', 'string', 'in:actor,producer']
        ];
    }
}
