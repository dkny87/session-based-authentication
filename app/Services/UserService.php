<?php

namespace App\Services;

use App\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var User
     */
    private $userService;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->userService = $user;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->userService->create($data);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function deleteWhere(array $params)
    {
        $user = $this->findWhere($params);

        return $user->delete();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function findWhere(array $params)
    {
        return $this->userService->where($params)->first();
    }
}
