<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\HeaderInterface;
use CL\Mailer\Message\ResolvedBody;
use CL\Mailer\Message\ResolvedBodyInterface;
use CL\Mailer\Message\ResolvedHeader;
use CL\Mailer\Message\ResolvedHeaderInterface;

class ResolvedMessage implements ResolvedMessageInterface
{
    /**
     * @var ResolvedHeaderInterface
     */
    private $header;

    /**
     * @var ResolvedBodyInterface
     */
    private $body;

    /**
     * @param ResolvedHeaderInterface $header
     * @param ResolvedBodyInterface   $body
     */
    private function __construct(
        ResolvedHeaderInterface $header,
        ResolvedBodyInterface $body
    ) {
        $this->header = $header;
        $this->body = $body;
    }

    /**
     * @param HeaderInterface $header
     * @param BodyInterface   $body
     *
     * @return ResolvedMessageInterface
     */
    public static function fromHeaderAndBody(HeaderInterface $header, BodyInterface $body): ResolvedMessageInterface
    {
        $resolvedHeader = new ResolvedHeader($header);
        $resolvedBody = new ResolvedBody($body);

        return new static($resolvedHeader, $resolvedBody);
    }

    /**
     * @inheritdoc
     */
    public function getHeader(): ResolvedHeaderInterface
    {
        return $this->header;
    }

    /**
     * @inheritdoc
     */
    public function getBody(): ResolvedBodyInterface
    {
        return $this->body;
    }
}
