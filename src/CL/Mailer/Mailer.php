<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Driver\DriverInterface;

/**
 * Wrapper combining the message resolver and driver allowing users to
 * conveniently send emails of any type and with any driver in one call
 */
class Mailer implements MailerInterface
{
    /**
     * @var MessageResolverInterface
     */
    private $messageResolver;

    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * @param MessageResolverInterface $messageResolver
     * @param DriverInterface          $driver
     */
    public function __construct(
        MessageResolverInterface $messageResolver,
        DriverInterface $driver
    ) {
        $this->messageResolver = $messageResolver;
        $this->driver = $driver;
    }

    /**
     * @inheritdoc
     *
     * @return bool The return value of the configured driver
     */
    public function send(string $type, array $options = []) : bool
    {
        $resolvedMessage = $this->messageResolver->resolve($type, $options);

        return $this->driver->send($resolvedMessage);
    }
}
