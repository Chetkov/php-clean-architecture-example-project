<?php

namespace PHPCAEP\Model\User;

use PHPCAEP\Model\RepositoryInterface;

/**
 * Interface UserRepositoryInterface
 * @package PHPCAEP\Model\User
 * @method void save(User $model)
 * @method User|null find(string $uid)
 * @method User get(string $uid)
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByCredential(string $login, string $passwordHash): ?User;

    public function getByCredential(string $login, string $passwordHash): User;
}
