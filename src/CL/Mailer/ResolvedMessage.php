<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\AddressInterface;

class ResolvedMessage implements ResolvedMessageInterface
{
    /**
     * @var array
     */
    private $from;

    /**
     * @var AddressInterface|null
     */
    private $sender;

    /**
     * @var null|string
     */
    private $subject;

    /**
     * @var array
     */
    private $to;

    /**
     * @var array
     */
    private $cc;

    /**
     * @var array
     */
    private $bcc;

    /**
     * @var array
     */
    private $replyTo;

    /**
     * @var array
     */
    private $parts;

    /**
     * @var array
     */
    private $attachments;

    /**
     * @param array                 $from
     * @param AddressInterface|null $sender
     * @param string|null           $subject
     * @param array                 $to
     * @param array                 $cc
     * @param array                 $bcc
     * @param array                 $replyTo
     * @param array                 $parts
     * @param array                 $attachments
     */
    public function __construct(
        array $from,
        AddressInterface $sender = null,
        string $subject = null,
        array $to,
        array $cc = [],
        array $bcc = [],
        array $replyTo = [],
        array $parts = [],
        array $attachments = []
    ) {
        $this->from = $from;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->to = $to;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->replyTo = $replyTo;
        $this->parts = $parts;
        $this->attachments = $attachments;
    }

    /**
     * @param MessageBuilderInterface $builder
     *
     * @return self
     */
    public static function fromBuilder(MessageBuilderInterface $builder) : self
    {
        return new self(
            $builder->getFrom(),
            $builder->getSender(),
            $builder->getSubject(),
            $builder->getTo(),
            $builder->getCc(),
            $builder->getBcc(),
            $builder->getReplyTo(),
            $builder->getParts(),
            $builder->getAttachments()
        );
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
    public function getSender(): ?AddressInterface
    {
        return $this->sender;
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
    public function getTo(): array
    {
        return $this->to;
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
    public function getBcc(): array
    {
        return $this->bcc;
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
    public function getParts(): array
    {
        return $this->parts;
    }

    /**
     * @inheritdoc
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
}
