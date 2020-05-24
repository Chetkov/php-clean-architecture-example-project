<?php

namespace PHPCAEP\UseCase\CustomerPart\Office;

use PHPCAEP\Model\Location\Address;
use PHPCAEP\Model\User\Contact\Email;
use PHPCAEP\Model\User\Contact\Phone;
use PHPCAEP\Model\User\Fio;
use PHPCAEP\Model\User\User;
use PHPCAEP\Model\User\UserRepositoryInterface;
use PHPCAEP\UseCase\CommonService\Notification\NotifierInterface;

/**
 * Class UserRegistrationService
 * @package PHPCAEP\UseCase\CustomerPart\Office
 */
class UserRegistrationService
{
    private UserRepositoryInterface $userRepository;
    private NotifierInterface $notifier;

    /**
     * UserRegistrationService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param NotifierInterface $notifier
     */
    public function __construct(UserRepositoryInterface $userRepository, NotifierInterface $notifier)
    {
        $this->userRepository = $userRepository;
        $this->notifier = $notifier;
    }

    /**
     * @param array $request
     * @return string user uid
     */
    public function register(array $request): string
    {
        $user = new User(
            $request['login'],
            $request['password'],
            new Fio(
                $request['first_name'],
                $request['last_name'] ?? null,
                $request['middle_name'] ?? null,
            ),
            new Address(
                $request['country'],
                $request['city'],
                $request['street'],
                $request['house'],
                $request['flat'],
            )
        );

        $contacts = $user->getContacts();
        foreach ($request['contacts'] as $contact) {
            switch ($contact['type']) {
                case 'email':
                    $contacts->add(new Email($contact['contact']));
                    break;
                case 'phone':
                    $contacts->add(new Phone($contact['contact']));
                    break;
                default:
                    throw new \RuntimeException(sprintf('Unsupported contact type %s', $contact['type']));
            }
        }

        $this->userRepository->save($user);
        $this->notifyAboutRegistration($user);

        return $user->getUid();
    }

    /**
     * @param User $user
     */
    private function notifyAboutRegistration(User $user): void
    {
        foreach ($user->getContacts() as $contact) {
            $this->notifier->notify($contact, "{$user->getFio()->getFirstName()}, Спасибо за регистрацию!");
        }
    }
}
