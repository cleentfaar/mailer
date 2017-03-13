<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\Part\PartInterface;

interface MessageBodyInterface
{
    /**
     * @param PartInterface $part
     */
    public function addPart(PartInterface $part);

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment);
}
