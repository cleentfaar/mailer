<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\AddressInterface;
use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\Part\PartInterface;
use CL\Mailer\Message\SubjectInterface;

interface MessageBuilderInterface
{
    /**
     * @param AddressInterface|null $sender
     */
    public function setSender(AddressInterface $sender = null);

    /**
     * @return AddressInterface|null
     */
    public function getSender(): ?AddressInterface;

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
     * @param SubjectInterface|null $subject
     */
    public function setSubject(SubjectInterface $subject = null);

    /**
     * @return SubjectInterface|null
     */
    public function getSubject(): ?SubjectInterface;

    /**
     * @param PartInterface $part
     */
    public function addPart(PartInterface $part);

    /**
     * @param PartInterface $part
     */
    public function removePart(PartInterface $part);

    /**
     * @return PartInterface[]
     */
    public function getParts(): array;

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment);

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array;
}
