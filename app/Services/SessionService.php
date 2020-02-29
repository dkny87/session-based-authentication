<?php

namespace App\Services;

use App\Session;

/**
 * Class SessionService
 * @package App\Services
 */
class SessionService
{
    /**
     * @var Session
     */
    private $session;

    /**
     * SessionService constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->session->create($data);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function deleteWhere(array $params)
    {
        $session = $this->findWhere($params);

        return $session->delete();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function findWhere(array $params)
    {
        return $this->session->where($params)->first();
    }
}
