<?php

namespace PHPCAEP\UseCase\CommonService\Notification;

use PHPCAEP\Model\User\Contact\Contact;

/**
 * Interface NotifierInterface
 * @package PHPCAEP\UseCase\CommonService\Notification
 */
interface NotifierInterface
{
    /**
     * @param Contact $contact
     * @param string $message
     * @throws NotificationFailException
     */
    public function notify(Contact $contact, string $message): void;
}
