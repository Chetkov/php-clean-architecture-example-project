<?php

namespace PHPCAEP\Model\User;

/**
 * Class Fio
 * @package PHPCAEP\Model\User
 */
class Fio
{
    private string $firstName;
    private ?string $lastName;
    private ?string $middleName;

    /**
     * Fio constructor.
     * @param string $firstName
     * @param string|null $lastName
     * @param string|null $middleName
     */
    public function __construct(string $firstName, ?string $lastName, ?string $middleName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Fio
     */
    public function setFirstName(string $firstName): Fio
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return Fio
     */
    public function setLastName(?string $lastName): Fio
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     * @return Fio
     */
    public function setMiddleName(?string $middleName): Fio
    {
        $this->middleName = $middleName;
        return $this;
    }
}
