<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

interface AddressInterface
{
    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string|null
     */
    public function getName(): ?string;
}
