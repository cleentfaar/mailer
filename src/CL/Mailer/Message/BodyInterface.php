<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Body\Attachment\AttachmentInterface;
use CL\Mailer\Message\Body\Part\PartInterface;

interface BodyInterface
{
    /**
     * @param PartInterface $part
     */
    public function setMainPart(PartInterface $part);

    /**
     * @return PartInterface
     */
    public function getMainPart(): PartInterface;

    /**
     * @param PartInterface|null $part
     */
    public function setAlternativePart(PartInterface $part = null);

    /**
     * @return PartInterface|null
     */
    public function getAlternativePart(): ?PartInterface;

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment);

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array;
}
