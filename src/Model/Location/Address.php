<?php

namespace PHPCAEP\Model\Location;

/**
 * Class Address
 * @package PHPCAEP\Model\Location
 */
class Address
{
    private string $country;
    private string $city;
    private string $street;
    private string $house;
    private string $flat;

    /**
     * Address constructor.
     * @param string $country
     * @param string $city
     * @param string $street
     * @param string $house
     * @param string $flat
     */
    public function __construct(string $country, string $city, string $street, string $house, string $flat)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
        $this->flat = $flat;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getHouse(): string
    {
        return $this->house;
    }

    /**
     * @return string
     */
    public function getFlat(): string
    {
        return $this->flat;
    }
}
