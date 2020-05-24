<?php

namespace PHPCAEP\Infrastructure\Repository\InMemory;

use PHPCAEP\Model\Model;
use PHPCAEP\Model\RepositoryInterface;

/**
 * Class AbstractInMemoryRepository
 * @package PHPCAEP\Infrastructure\Repository\InMemory
 */
abstract class AbstractInMemoryRepository implements RepositoryInterface
{
    protected array $storage = [];

    /**
     * @param Model $model
     */
    public function save(Model $model): void
    {
        $className = get_class($model);
        if (!isset($this->storage[$className])) {
            $this->storage[$className] = [];
        }

        $this->storage[$className][$model->getUid()] = $model;
    }

    /**
     * @param string $uid
     * @return Model|null
     */
    public function find(string $uid): ?Model
    {
        return $this->storage[$this->getModelClass()][$uid] ?? null;
    }

    /**
     * @param string $uid
     * @return Model
     */
    public function get(string $uid): Model
    {
        $model = $this->find($uid);
        if ($model) {
            return $model;
        }
        throw new \DomainException(sprintf('Model was not found! [Class: %s, UID: %s]', $this->getModelClass(), $uid));
    }

    abstract protected function getModelClass(): string;
}
