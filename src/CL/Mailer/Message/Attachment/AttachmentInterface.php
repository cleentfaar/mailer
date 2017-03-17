<?php

namespace CL\Mailer\Message\Attachment;

interface AttachmentInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return string|null
     */
    public function getContentType() : ?string;
}
