<?php

declare(strict_types=1);

namespace CL\Mailer\Message\Part;

use Pelago\Emogrifier;

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
     * @param string|null $pathToCss
     */
    public function __construct(string $content, string $charset = null, string $pathToCss = null)
    {
        if ($pathToCss !== null) {
            $emogrifier = new Emogrifier();
            $emogrifier->setCss(file_get_contents($pathToCss));
            $emogrifier->setHtml($content);

            $content = $emogrifier->emogrify();
        }

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
    public function getCharset(): ?string
    {
        return $this->charset;
    }

    /**
     * @inheritdoc
     */
    public function getContentType(): string
    {
        return 'text/html';
    }
}
