<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Body\Part\PartInterface;

class ResolvedBody implements ResolvedBodyInterface
{
    /**
     * @var BodyInterface
     */
    private $body;

    /**
     * @param BodyInterface $body
     */
    public function __construct(
        BodyInterface $body
    ) {
        $this->body = $body;
    }

    /**
     * @inheritdoc
     */
    public function getMainPart(): PartInterface
    {
        return $this->body->getMainPart();
    }

    /**
     * @inheritdoc
     */
    public function getAlternativePart(): ?PartInterface
    {
        return $this->body->getAlternativePart();
    }

    /**
     * @inheritdoc
     */
    public function getAttachments(): array
    {
        return $this->body->getAttachments();
    }
}
