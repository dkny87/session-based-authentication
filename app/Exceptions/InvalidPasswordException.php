<?php

namespace App\Exceptions;

use App\Exceptions\Errors\ErrorCode;

class InvalidPasswordException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function errorCode()
    {
        return ErrorCode::INVALID_PASSWORD;
    }

    /**
     * @inheritDoc
     */
    public function statusCode()
    {
        return 401;
    }
}
