<?php

namespace PHPCAEP\Infrastructure\Notification\Email;

use PHPCAEP\Model\User\Contact\Contact;
use PHPCAEP\Model\User\Contact\Email;
use PHPCAEP\UseCase\CommonService\Notification\NotifierInterface;

/**
 * Class EmailNotifier
 * @package PHPCAEP\Infrastructure\Notification\Email
 */
class EmailNotifier implements NotifierInterface
{
    /**
     * @inheritDoc
     */
    public function notify(Contact $contact, string $message): void
    {
        if (!$contact instanceof Email) {
            return;
        }
        //Имитация отправки письма
        echo "Send email '$message' to '{$contact->getValue()}'" . PHP_EOL;
    }
}
