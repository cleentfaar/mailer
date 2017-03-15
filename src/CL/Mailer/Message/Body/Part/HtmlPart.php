<?php

declare(strict_types=1);

namespace CL\Mailer\Message\Body\Part;

class HtmlPart implements PartInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string|null
     */
    private $charset;

    /**
     * @param string      $content
     * @param string|null $charset
     */
    public function __construct(string $content, string $charset = null)
    {
        $this->content = $content;
        $this->charset = $charset;
    }

    /**
     * @inheritdoc
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @inheritdoc
     */
    public function getContentType() : string
    {
        return 'text/html';
    }

    /**
     * @inheritdoc
     */
    public function getCharset() : ?string
    {
        return $this->charset;
    }
}
