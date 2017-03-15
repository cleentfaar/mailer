<?php

namespace CL\Mailer\Message\Header;

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