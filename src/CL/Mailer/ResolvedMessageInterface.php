<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\AddressInterface;
use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\Part\PartInterface;

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
     * @return PartInterface[]
     */
    public function getParts(): array;

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array;
}
