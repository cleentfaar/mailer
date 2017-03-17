<?php

namespace CL\Mailer;

use CL\Mailer\Message\AddressInterface;
use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\Part\PartInterface;

class MessageBuilder implements MessageBuilderInterface
{
    /**
     * @var AddressInterface|null
     */
    private $sender;

    /**
     * @var AddressInterface[]
     */
    private $from = [];

    /**
     * @var AddressInterface[]
     */
    private $to = [];

    /**
     * @var AddressInterface[]
     */
    private $cc = [];

    /**
     * @var AddressInterface[]
     */
    private $bcc = [];

    /**
     * @var AddressInterface[]
     */
    private $replyTo = [];

    /**
     * @var string|null
     */
    private $subject;

    /**
     * @var PartInterface[]
     */
    private $parts = [];

    /**
     * @var AttachmentInterface[]
     */
    private $attachments = [];

    /**
     * @inheritdoc
     */
    public function setSender(AddressInterface $sender = null)
    {
        $this->sender = $sender;
    }

    /**
     * @inheritdoc
     */
    public function getSender(): ?AddressInterface
    {
        return $this->sender;
    }

    /**
     * @inheritdoc
     */
    public function addFrom(AddressInterface $address)
    {
        $this->from[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @inheritdoc
     */
    public function addTo(AddressInterface $address)
    {
        $this->to[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @inheritdoc
     */
    public function addCc(AddressInterface $address)
    {
        $this->cc[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @inheritdoc
     */
    public function addBcc(AddressInterface $address)
    {
        $this->bcc[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    /**
     * @inheritdoc
     */
    public function addReplyTo(AddressInterface $address)
    {
        $this->replyTo[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function getReplyTo(): array
    {
        return $this->replyTo;
    }

    /**
     * @inheritdoc
     */
    public function setSubject(string $subject = null)
    {
        $this->subject = $subject;
    }

    /**
     * @inheritdoc
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @inheritdoc
     */
    public function addPart(PartInterface $part)
    {
        $this->parts[] = $part;
    }

    /**
     * @inheritdoc
     */
    public function getParts(): array
    {
        return $this->parts;
    }

    /**
     * @inheritdoc
     */
    public function addAttachment(AttachmentInterface $attachment)
    {
        $this->attachments[] = $attachment;
    }

    /**
     * @inheritdoc
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
}