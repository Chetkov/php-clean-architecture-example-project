<?php

namespace PHPCAEP\Infrastructure\Notification\Sms;

use PHPCAEP\Model\User\Contact\Contact;
use PHPCAEP\Model\User\Contact\Phone;
use PHPCAEP\UseCase\CommonService\Notification\NotifierInterface;

/**
 * Class SmsNotifier
 * @package PHPCAEP\Infrastructure\Notification\Sms
 */
class SmsNotifier implements NotifierInterface
{
    /**
     * @inheritDoc
     */
    public function notify(Contact $contact, string $message): void
    {
        if (!$contact instanceof Phone) {
            return;
        }
        // Имитация отправки СМС
        echo "Send sms '$message' to '{$contact->getValue()}'" . PHP_EOL;
    }
}
