<?php

namespace PHPCAEP\UseCase\CustomerPart\Office;

use PHPCAEP\Model\User\User;
use PHPCAEP\Model\User\UserRepositoryInterface;

/**
 * Class PasswordChangingService
 * @package PHPCAEP\UseCase\CustomerPart\Office
 */
class PasswordChangingService
{
    private UserRepositoryInterface $userRepository;

    /**
     * PasswordChangingService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $newPassword
     */
    public function change(string $login, string $password, string $newPassword): void
    {
        $user = $this->userRepository->getByCredential($login, User::hashPassword($password));
        $user->setPassword($newPassword);
        $this->userRepository->save($user);
    }
}
