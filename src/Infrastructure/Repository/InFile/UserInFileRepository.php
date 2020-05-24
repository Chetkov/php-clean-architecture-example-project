<?php

namespace PHPCAEP\Infrastructure\Repository\InFile;

use PHPCAEP\Model\User\User;
use PHPCAEP\Model\User\UserRepositoryInterface;

/**
 * Class UserInFileRepository
 * @package PHPCAEP\Infrastructure\Repository\InFile
 */
class UserInFileRepository extends AbstractInFileRepository implements UserRepositoryInterface
{
    public function findByCredential(string $login, string $passwordHash): ?User
    {
        $pattern = str_replace([$this->storageDirectoryPath, '/'], '', $this->makeFilename(''));
        $files = new \RegexIterator(
            new \DirectoryIterator($this->storageDirectoryPath),
            "/{$pattern}/i"
        );

        /** @var \SplFileInfo $file */
        foreach ($files as $file) {
            $serialized = file_get_contents($file->getRealPath());
            $user = unserialize($serialized);
            if ($user instanceof User && $user->getLogin() === $login && $user->getPasswordHash() === $passwordHash) {
                return $user;
            }
        }

        return null;
    }

    public function getByCredential(string $login, string $passwordHash): User
    {
        $user = $this->findByCredential($login, $passwordHash);
        if ($user) {
            return $user;
        }
        throw new \DomainException(sprintf('User was not found! [login: %s, passwordHash: %s]', $login, $passwordHash));
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return User::class;
    }
}
