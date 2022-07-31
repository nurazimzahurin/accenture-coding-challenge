<?php

namespace App\Http\Requests;

use App\Repositories\MovieCelebrityRepository;
use App\Rules\CelebrityAlreadyActorRule;
use App\Rules\MovieOnlyOneProducerRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateMovieCelebrityRequest extends FormRequest
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
            'celebrity_id' => ['required', 'int', 'exists:celebrities,id'],
            'role' => ['required', 'string', 'in:actor,producer', new CelebrityAlreadyActorRule($this->movie_id, $this->celebrity_id, $this->movieCelebrityRepository), new MovieOnlyOneProducerRule($this->movie_id, $this->movieCelebrityRepository)]
        ];
    }
}
