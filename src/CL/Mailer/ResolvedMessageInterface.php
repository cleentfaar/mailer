<?php

namespace CL\Mailer;

use CL\Mailer\Message\AddressInterface;

interface ResolvedMessageInterface
{
    /**
     * @return AddressInterface[]
     */
    public function getFrom(): array;

    /**
     * @return AddressInterface|null
     */
    public function getSender(): ?AddressInterface;

    /**
     * @return string|null
     */
    public function getSubject(): ?string;

    /**
     * @return array
     */
    public function getTo(): array;

    /**
     * @return array
     */
    public function getCc(): array;

    /**
     * @return array
     */
    public function getBcc(): array;

    /**
     * @return array
     */
    public function getReplyTo(): array;

    /**
     * @return array
     */
    public function getParts(): array;

    /**
     * @return array
     */
    public function getAttachments(): array;
}