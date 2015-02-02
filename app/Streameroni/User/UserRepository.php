<?php

namespace Depotwarehouse\Streameroni\User;

use Depotwarehouse\Streameroni\BaseRepository;
use Depotwarehouse\Streameroni\NullValidator;

class UserRepository extends BaseRepository
{

    public function __construct(User $model, NullValidator $validator)
    {
        $this->model = $model;
        $this->validator = $validator;
    }

    public function getByUsername($username)
    {
        return $this->model
            ->where('username', $username)
            ->firstOrFail();
    }

}
