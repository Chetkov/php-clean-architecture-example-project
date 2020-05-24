<?php

namespace PHPCAEP\Infrastructure\Notification;

use PHPCAEP\Model\User\Contact\Contact;
use PHPCAEP\UseCase\CommonService\Notification\NotifierInterface;

/**
 * Class NotifierAggregator
 * @package PHPCAEP\Infrastructure\Notification
 */
class NotifierAggregator implements NotifierInterface
{
    /** @var NotifierInterface[] */
    private array $notifiers;

    /**
     * NotifierAggregator constructor.
     * @param NotifierInterface ...$notifiers
     */
    public function __construct(NotifierInterface ...$notifiers)
    {
        $this->notifiers = $notifiers;
    }

    /**
     * @inheritDoc
     */
    public function notify(Contact $contact, string $message): void
    {
        foreach ($this->notifiers as $notifier) {
            $notifier->notify($contact, $message);
        }
    }
}
