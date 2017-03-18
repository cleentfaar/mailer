<?php

declare(strict_types=1);

namespace CL\Mailer\Message\Part;

interface PartInterface
{
    /**
     * @return string
     */
    public function getContent() : string;

    /**
     * @param string $newContent
     */
    public function replaceContent(string $newContent);

    /**
     * @return string
     */
    public function getContentType() : string;

    /**
     * @return string|null
     */
    public function getCharset(): ?string;
}
