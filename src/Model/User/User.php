<?php

namespace PHPCAEP\Model\User;

use PHPCAEP\Infrastructure\Notification;
use PHPCAEP\Model\Location\Address;
use PHPCAEP\Model\Model;
use PHPCAEP\Model\Shop\OrderCollection;
use PHPCAEP\Model\User\Contact\Contact;
use PHPCAEP\Model\User\Contact\ContactCollection;
use PHPCAEP\Model\User\Contact\Phone;

/**
 * Class User
 * @package PHPCAEP\Model\User
 */
class User extends Model
{
    private string $login;
    private string $passwordHash;
    private Fio $fio;
    private Address $address;
    private ContactCollection $contacts;
    private OrderCollection $orders;

    /**
     * User constructor.
     * @param string $login
     * @param string $password
     * @param Fio $fio
     * @param Address $address
     * @param Contact[] $contacts
     */
    public function __construct(string $login, string $password, Fio $fio, Address $address, array $contacts = [])
    {
        parent::__construct();
        $this->login = $login;
        $this->setPassword($password);
        $this->fio = $fio;
        $this->address = $address;
        $this->contacts = new ContactCollection($contacts);
        $this->orders = new OrderCollection();

        (new Notification\Sms\SmsNotifier())->notify(new Phone('84956063602'), 'Чуваки, у нас тот новыю юзер зарегался!');
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->passwordHash = self::hashPassword($password);
        return $this;
    }

    /**
     * @return Fio
     */
    public function getFio(): Fio
    {
        return $this->fio;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return ContactCollection
     */
    public function getContacts(): ContactCollection
    {
        return $this->contacts;
    }

    /**
     * @return OrderCollection
     */
    public function getOrders(): OrderCollection
    {
        return $this->orders;
    }

    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return sha1($password);
    }
}
