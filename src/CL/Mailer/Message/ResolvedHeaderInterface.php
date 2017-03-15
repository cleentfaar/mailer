<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Header\AddressInterface;

interface ResolvedHeaderInterface
{
    /**
     * @return AddressInterface[]
     */
    public function getFrom(): array;

    /**
     * @return AddressInterface[]
     */
    public function getTo(): array;

    /**
     * @return AddressInterface[]
     */
    public function getCc(): array;

    /**
     * @return AddressInterface[]
     */
    public function getBcc(): array;

    /**
     * @return AddressInterface[]
     */
    public function getReplyTo(): array;

    /**
     * @return string|null
     */
    public function getSubject(): ?string;
}
