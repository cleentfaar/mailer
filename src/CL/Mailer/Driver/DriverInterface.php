<?php

declare(strict_types=1);

namespace CL\Mailer\Driver;

use CL\Mailer\ResolvedMessageInterface;

interface DriverInterface
{
    /**
     * Sends a given message.
     *
     * Note: depending on the driver, the returned value will only indicate
     * whether the message was added to it's internal queue (e.g. spool) or not.
     * It may still fail to be sent at a later point.
     *
     * Also note that after a message is successfully sent, it may still fail
     * to arrive due to intermittent issues or simply because of a non-existent recipient.
     *
     * @param ResolvedMessageInterface $message
     *
     * @return bool Whether the message was successfully sent or not.
     */
    public function send(ResolvedMessageInterface $message): bool;
}
