<?php

namespace PHPCAEP\Model;

/**
 * Interface RepositoryInterface
 * @package PHPCAEP\Model
 */
interface RepositoryInterface
{
    /**
     * @param Model $model
     */
    public function save(Model $model): void;

    /**
     * @param string $uid
     * @return Model|null
     */
    public function find(string $uid): ?Model;

    /**
     * @param string $uid
     * @return Model
     * @throws \DomainException
     */
    public function get(string $uid): Model;
}
