<?php

declare(strict_types=1);

namespace CL\Mailer;

interface MailerInterface
{
    /**
     * Sends a message through the configured driver using the given type and options.
     *
     * @param string $type
     * @param array  $options
     */
    public function send(string $type, array $options = []);
}