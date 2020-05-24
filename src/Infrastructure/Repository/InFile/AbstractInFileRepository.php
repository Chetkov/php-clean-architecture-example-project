<?php

namespace PHPCAEP\Infrastructure\Repository\InFile;

use PHPCAEP\Model\Model;
use PHPCAEP\Model\RepositoryInterface;

/**
 * Class AbstractInFileRepository
 * @package PHPCAEP\Infrastructure\Repository\InFile
 */
abstract class AbstractInFileRepository implements RepositoryInterface
{
    protected string $storageDirectoryPath;

    /**
     * AbstractInFileRepository constructor.
     * @param string $storageDirectoryPath
     */
    public function __construct(string $storageDirectoryPath = __DIR__ . '/../../../../data/storage')
    {
        $this->storageDirectoryPath = $storageDirectoryPath;
    }

    /**
     * @inheritDoc
     */
    public function save(Model $model): void
    {
        file_put_contents($this->makeFilename($model->getUid()), serialize($model));
    }

    /**
     * @inheritDoc
     */
    public function find(string $uid): ?Model
    {
        $filename = $this->makeFilename($uid);
        if (file_exists($filename)) {
            $serialized = file_get_contents($filename);
            return unserialize($serialized);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function get(string $uid): Model
    {
        $model = $this->find($uid);
        if ($model) {
            return $model;
        }
        throw new \DomainException(sprintf('Model was not found! [Class: %s, UID: %s]', $this->getModelClass(), $uid));
    }

    /**
     * @param string $uid
     * @return string
     */
    protected function makeFilename(string $uid): string
    {
        $prefix = str_replace('\\', '', $this->getModelClass());
        return "{$this->storageDirectoryPath}/{$prefix}_{$uid}";
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;
}
