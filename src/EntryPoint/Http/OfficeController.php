<?php

namespace PHPCAEP\EntryPoint\Http;

use PHPCAEP\UseCase\CustomerPart\Office\PasswordChangingService;
use PHPCAEP\UseCase\CustomerPart\Office\UserRegistrationService;

/**
 * Class OfficeController
 * @package PHPCAEP\EntryPoint\Http
 */
class OfficeController
{
    /**
     * @param UserRegistrationService $service
     * @param array $request
     * @return array
     */
    public function register(UserRegistrationService $service, array $request): array
    {
        $userUid = $service->register($request);
        return [
            'uid' => $userUid,
        ];
    }

    /**
     * @param PasswordChangingService $service
     * @param array $request
     */
    public function changePassword(PasswordChangingService $service, array $request): void
    {
        $service->change($request['login'], $request['password'], $request['new_password']);
    }
}
