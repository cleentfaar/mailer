<?php

declare(strict_types=1);

namespace CL\Mailer\Test\Driver;

use CL\Mailer\DriverInterface;
use CL\Mailer\ResolvedMessageInterface;

class InMemoryDriver implements DriverInterface
{
    /**
     * @var ResolvedMessageInterface[]
     */
    private $messagesSent;

    /**
     * @inheritdoc
     */
    public function send(ResolvedMessageInterface $message): bool
    {
        $this->messagesSent[] = $message;

        return true;
    }

    /**
     * @return ResolvedMessageInterface[]
     */
    public function getMessagesSent(): array
    {
        return $this->messagesSent;
    }
}
