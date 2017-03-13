<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\Part\PartInterface;

class MessageBody implements MessageBodyInterface
{
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
    public function addPart(PartInterface $part)
    {
        $this->parts[] = $part;
    }

    /**
     * @return PartInterface[]
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
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
}
