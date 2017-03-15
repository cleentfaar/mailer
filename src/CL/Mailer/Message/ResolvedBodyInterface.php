<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Message\Body\Attachment\AttachmentInterface;
use CL\Mailer\Message\Body\Part\PartInterface;

interface ResolvedBodyInterface
{
    /**
     * @return PartInterface
     */
    public function getMainPart(): PartInterface;

    /**
     * @return PartInterface|null
     */
    public function getAlternativePart(): ?PartInterface;

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array;
}
