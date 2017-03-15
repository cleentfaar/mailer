<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Body\Attachment\AttachmentInterface;
use CL\Mailer\Message\Body\Part\PartInterface;

class Body implements BodyInterface
{
    /**
     * @var PartInterface
     */
    private $mainPart;

    /**
     * @var PartInterface|null
     */
    private $alternativePart;

    /**
     * @var AttachmentInterface[]
     */
    private $attachments = [];

    /**
     * @inheritdoc
     */
    public function setMainPart(PartInterface $part)
    {
        $this->mainPart = $part;
    }

    /**
     * @inheritdoc
     */
    public function getMainPart(): PartInterface
    {
        return $this->mainPart;
    }

    /**
     * @inheritdoc
     */
    public function setAlternativePart(PartInterface $part = null)
    {
        $this->alternativePart = $part;
    }

    /**
     * @inheritdoc
     */
    public function getAlternativePart(): ?PartInterface
    {
        return $this->alternativePart;
    }

    /**
     * @inheritdoc
     */
    public function addAttachment(AttachmentInterface $attachment)
    {
        $this->attachments[] = $attachment;
    }

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
}
