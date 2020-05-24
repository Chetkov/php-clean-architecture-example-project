<?php

namespace PHPCAEP\Model\Collection;

/**
 * Class Collection
 * @package PHPCAEP\Model\Collection
 */
abstract class Collection extends AbstractCollection
{
    /**
     * @return mixed
     */
    public function getFirst()
    {
        return reset($this->storage);
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        return end($this->storage);
    }

    /**
     * @param mixed $element
     * @return static
     */
    public function add($element)
    {
        $this->validateElement($element);
        $this->storage[] = $element;
        return $this;
    }

    /**
     * @param mixed $element
     * @return static
     */
    public function addIfNotExist($element)
    {
        if (!in_array($element, $this->storage, true)) {
            $this->add($element);
        }
        return $this;
    }

    /**
     * @param mixed $element
     * @return bool
     */
    public function contains($element): bool
    {
        return in_array($element, $this->storage, true);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->storage);
    }
}
