<?php

namespace App\Repositories;

use App\Models\Celebrity;

class CelebrityRepository {

    private $celebrityModel;

    public function __construct(Celebrity $celebrity)
    {
        $this->celebrityModel = $celebrity;
    }

    public function create($request)
    {
        return $this->celebrityModel->create([
            'name' => $request['name'], 
            'sex' => $request['sex'], 
            'dob' => $request['dob'],
            'bio' => $request['bio']
        ]);
    }

    public function find($celebrityID)
    {
        return $this->celebrityModel->with(['movies', 'acting', 'producing'])
            ->where('id', $celebrityID)
            ->first();
    }

    public function get()
    {
        return $this->celebrityModel->all();
    }
}