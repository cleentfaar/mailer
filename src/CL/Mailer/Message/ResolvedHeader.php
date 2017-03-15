<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

class ResolvedHeader implements ResolvedHeaderInterface
{
    /**
     * @var HeaderInterface
     */
    private $header;

    /**
     * @param HeaderInterface $header
     */
    public function __construct(
        HeaderInterface $header
    ) {
        $this->header = $header;
    }

    /**
     * @inheritdoc
     */
    public function getFrom(): array
    {
        return $this->header->getFrom();
    }

    /**
     * @inheritdoc
     */
    public function getTo(): array
    {
        return $this->header->getTo();
    }

    /**
     * @inheritdoc
     */
    public function getCc(): array
    {
        return $this->header->getCc();
    }

    /**
     * @inheritdoc
     */
    public function getBcc(): array
    {
        return $this->header->getBcc();
    }

    /**
     * @inheritdoc
     */
    public function getReplyTo(): array
    {
        return $this->header->getReplyTo();
    }

    /**
     * @inheritdoc
     */
    public function getSubject(): ?string
    {
        return $this->header->getSubject();
    }
}
