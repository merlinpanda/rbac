<?php

namespace Merlinpanda\Rbac\Exceptions;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AccessDeniedException extends AccessDeniedHttpException
{
    public function __construct(string $message = '')
    {
        $code = ErrorCodes::ACCESS_DENIED;
        $err_msg = $message ?: __("rbac::rbac.access_denied");
        parent::__construct($err_msg, null, $code, []);
    }
}
