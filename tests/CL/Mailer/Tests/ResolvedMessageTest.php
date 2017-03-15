<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\HeaderInterface;
use CL\Mailer\Message\ResolvedBodyInterface;
use CL\Mailer\Message\ResolvedHeaderInterface;
use CL\Mailer\ResolvedMessage;
use PHPUnit\Framework\TestCase;

class ResolvedMessageTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_constructed_from_a_given_header_and_body()
    {
        $header = $this->prophesize(HeaderInterface::class)->reveal();
        $body = $this->prophesize(BodyInterface::class)->reveal();

        $resolvedMessage = ResolvedMessage::fromHeaderAndBody($header, $body);

        $this->assertInstanceOf(ResolvedHeaderInterface::class, $resolvedMessage->getHeader());
        $this->assertInstanceOf(ResolvedBodyInterface::class, $resolvedMessage->getBody());
    }
}
