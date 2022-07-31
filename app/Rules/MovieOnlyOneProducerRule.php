<?php

namespace App\Rules;

use App\Repositories\MovieCelebrityRepository;
use Illuminate\Contracts\Validation\Rule;

class MovieOnlyOneProducerRule implements Rule
{
    private $movieID, $movieCelebrityRepository;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($movieID, MovieCelebrityRepository $movieCelebrityRepository)
    {
        $this->movieID = $movieID;
        $this->movieCelebrityRepository = $movieCelebrityRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exist = $this->movieCelebrityRepository->checkIfProducerExist($this->movieID);

        if (isset($exist))
            return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Producer already exist.';
    }
}
