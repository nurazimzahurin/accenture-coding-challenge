<?php

namespace App\Rules;

use App\Repositories\MovieCelebrityRepository;
use Illuminate\Contracts\Validation\Rule;

class CelebrityAlreadyActorRule implements Rule
{
    private $movieID, $celebrityID, $movieCelebrityRepository, $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($movieID, $celebrityID, MovieCelebrityRepository $movieCelebrityRepository)
    {
        $this->movieID = $movieID;
        $this->celebrityID = $celebrityID;
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
        $exist = $this->movieCelebrityRepository->find($this->movieID, $this->celebrityID, $value);

        if (isset($exist)) {
            switch ($value) {
                case 'actor':
                    $this->message = 'Celebrity is already an actor for this movie.';
                    break;
                case 'producer':
                    $this->message = 'Celebrity is already a producer for this movie.';
                    break;
            }

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
