<?php

namespace PHPCAEP\Model\Shop;

/**
 * Class Status
 * @package PHPCAEP\Model\Shop
 */
class Status
{
    public const BOOKED = 'booked';
    public const PAID = 'paid';
    public const PROCESSED = 'processed';
    public const DELIVERED = 'delivered';
    public const CANCELLED = 'cancelled';
    public const REFUNDED = 'refunded';
    public const ALLOWED_STATUSES = [
        self::BOOKED,
        self::PAID,
        self::PROCESSED,
        self::DELIVERED,
        self::CANCELLED,
        self::REFUNDED,
    ];

    private string $status;

    /**
     * Status constructor.
     * @param string $status
     */
    public function __construct(string $status = self::BOOKED)
    {
        if (!in_array($status, self::ALLOWED_STATUSES, true)) {
            throw new \InvalidArgumentException(sprintf('$status must be one of: %s', implode(', ', self::ALLOWED_STATUSES)));
        }
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isBooked(): bool
    {
        return $this->status === self::BOOKED;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->status === self::PAID;
    }

    /**
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->status === self::PROCESSED;
    }

    /**
     * @return bool
     */
    public function isDelivered(): bool
    {
        return $this->status === self::DELIVERED;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->status === self::CANCELLED;
    }

    /**
     * @return bool
     */
    public function isRefunded(): bool
    {
        return $this->status === self::REFUNDED;
    }

    /**
     * @return $this
     */
    public function toPaid(): self
    {
        // check current status
        $this->status = self::PAID;
        return $this;
    }

    /**
     * @return $this
     */
    public function toProcessed(): self
    {
        // check current status
        $this->status = self::PROCESSED;
        return $this;
    }

    /**
     * @return $this
     */
    public function toDelivered(): self
    {
        // check current status
        $this->status = self::DELIVERED;
        return $this;
    }

    /**
     * @return $this
     */
    public function toCancelled(): self
    {
        // check current status
        $this->status = self::CANCELLED;
        return $this;
    }

    /**
     * @return $this
     */
    public function toRefunded(): self
    {
        // check current status
        $this->status = self::REFUNDED;
        return $this;
    }
}
