<?php

namespace App\Http\Requests;

use App\Repositories\MovieCelebrityRepository;
use App\Rules\MovieOnlyOneProducerRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCelebrityRequest extends FormRequest
{
    private $movieCelebrityRepository;

    public function __construct(MovieCelebrityRepository $movieCelebrityRepository)
    {
        $this->movieCelebrityRepository = $movieCelebrityRepository;
    }

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
            'name' => ['required', 'string'], 
            'sex' => ['required', 'string', 'in:male,female'], 
            'dob' => ['required', 'string'],
            'bio' => ['required', 'string'],
            'role' => ['required', 'string', 'in:actor,producer', new MovieOnlyOneProducerRule($this->movie_id, $this->movieCelebrityRepository)]
        ];
    }
}
