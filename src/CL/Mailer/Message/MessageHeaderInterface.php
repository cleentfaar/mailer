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
     * @param Address $recipient
     */
    public function addTo(Address $recipient);

    /**
     * @param Address $recipient
     */
    public function addCc(Address $recipient);

    /**
     * @param Address $recipient
     */
    public function addBcc(Address $recipient);

    /**
     * @param Address $recipient
     */
    public function addReplyTo(Address $recipient);

    /**
     * @param string $subject
     */
    public function setSubject(string $subject);
}
