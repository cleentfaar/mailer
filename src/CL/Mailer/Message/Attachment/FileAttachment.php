<?php

namespace CL\Mailer\Message\Attachment;

use Symfony\Component\HttpFoundation\File\File;

class FileAttachment implements AttachmentInterface
{
    /**
     * @var File
     */
    private $file;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * @inheritdoc
     */
    public function getData(): string
    {
        return file_get_contents($this->file->getRealPath());
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->file->getRealPath();
    }

    /**
     * @inheritdoc
     */
    public function getContentType(): ?string
    {
        return $this->file->getMimeType();
    }
}