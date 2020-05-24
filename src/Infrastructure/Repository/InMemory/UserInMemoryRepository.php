<?php

namespace PHPCAEP\Infrastructure\Repository\InMemory;

use PHPCAEP\Model\User\User;
use PHPCAEP\Model\User\UserRepositoryInterface;

/**
 * Class UserInMemoryRepository
 * @package PHPCAEP\Infrastructure\Repository\InMemory
 * @method save(User $model)
 * @method User get(string $uid)
 */
class UserInMemoryRepository extends AbstractInMemoryRepository implements UserRepositoryInterface
{
    /**
     * @param string $uid
     * @return User
     */
    public function find(string $uid): User
    {
        /** @var User $user */
        $user = parent::find($uid);
        return $user;
    }

    /**
     * @param string $login
     * @param string $passwordHash
     * @return User|null
     */
    public function findByCredential(string $login, string $passwordHash): ?User
    {
        /** @var User[] $storage */
        $storage = $this->storage[$this->getModelClass()] ?? [];
        foreach ($storage as $user) {
            if ($user->getLogin() === $login && $user->getPasswordHash() === $passwordHash) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @param string $login
     * @param string $passwordHash
     * @return User
     */
    public function getByCredential(string $login, string $passwordHash): User
    {
        $user = $this->findByCredential($login, $passwordHash);
        if ($user) {
            return $user;
        }
        throw new \DomainException(sprintf('User was not found! [login: %s, passwordHash: %s]', $login, $passwordHash));
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }
}
