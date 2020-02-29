<?php

namespace App\Services\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Services\SessionService;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

/**
 * Class AuthService
 * @package App\Services\Auth
 */
class AuthService
{
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * AuthService constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService, UserService $userService)
    {
        $this->sessionService = $sessionService;
        $this->userService = $userService;
    }

    /**
     * @param $email
     * @param $password
     * @return array
     * @throws Exception
     */
    public function login($email, $password)
    {
        // Find user by email
        $user = $this->userService->findWhere(['email' => $email]);

        // Check user credentials
        if (!Hash::check($password, optional($user)->password)) {
            throw new InvalidCredentialsException();
        }

        // Generate string using Ramsey/UUID
        $sessionId = (string)Uuid::uuid5(Uuid::NAMESPACE_DNS, $user->email);

        // One day expiration
        $expiredAt = 60 * 60 * 24;

        // Insert data to session table
        $this->sessionService->create([
            'session_id' => $sessionId,
            'session_info' => '',
            'expired_at' => $expiredAt
        ]);

        return [
            'session_id' => $sessionId,
            'user_info' => $user,
        ];
    }

    /**
     * @param $sessionId
     * @return void
     */
    public function logout($sessionId)
    {
        $session = $this->sessionService->findWhere(['session_id' => $sessionId]);

        return $session->delete();
    }
}
