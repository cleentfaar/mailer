<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Header\AddressInterface;

interface HeaderInterface
{
    /**
     * @param AddressInterface $from
     */
    public function addFrom(AddressInterface $from);

    /**
     * @return AddressInterface[]
     */
    public function getFrom(): array;

    /**
     * @param AddressInterface $recipient
     */
    public function addTo(AddressInterface $recipient);

    /**
     * @return AddressInterface[]
     */
    public function getTo(): array;

    /**
     * @param AddressInterface $recipient
     */
    public function addCc(AddressInterface $recipient);

    /**
     * @return AddressInterface[]
     */
    public function getCc(): array;

    /**
     * @param AddressInterface $recipient
     */
    public function addBcc(AddressInterface $recipient);

    /**
     * @return AddressInterface[]
     */
    public function getBcc(): array;

    /**
     * @param AddressInterface $recipient
     */
    public function addReplyTo(AddressInterface $recipient);

    /**
     * @return AddressInterface[]
     */
    public function getReplyTo(): array;

    /**
     * @param string $subject
     */
    public function setSubject(string $subject);

    /**
     * @return string|null
     */
    public function getSubject(): ?string;
}
