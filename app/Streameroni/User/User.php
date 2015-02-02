<?php

namespace Depotwarehouse\Streameroni\User;

use Depotwarehouse\Toolbox\DataManagement\EloquentModels\BaseModel;
use Illuminate\Auth\UserInterface;

class User extends BaseModel implements UserInterface
{

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    protected $meta = [
        'id' => [ self::FILLABLE ],
        'display_name' => [ self::FILLABLE ],
        'username' => [ self::FILLABLE ],
        'email' => [ self::FILLABLE ],
    ];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }
    public function getAuthPassword()
    {
    }
    public function getRememberToken()
    {
    }
    public function setRememberToken($value)
    {
    }
    public function getRememberTokenName()
    {
    }
}
