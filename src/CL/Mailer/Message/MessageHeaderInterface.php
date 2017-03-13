<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

interface MessageHeaderInterface
{
    /**
     * @param Address $from
     */
    public function addFrom(Address $from);

    /**
     * @return Address[]
     */
    public function getFrom(): array;

    /**
     * @param Address $recipient
     */
    public function addTo(Address $recipient);

    /**
     * @return Address[]
     */
    public function getTo(): array;

    /**
     * @param Address $recipient
     */
    public function addCc(Address $recipient);

    /**
     * @return Address[]
     */
    public function getCc(): array;

    /**
     * @param Address $recipient
     */
    public function addBcc(Address $recipient);

    /**
     * @return Address[]
     */
    public function getBcc(): array;

    /**
     * @param Address $recipient
     */
    public function addReplyTo(Address $recipient);

    /**
     * @return Address[]
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
