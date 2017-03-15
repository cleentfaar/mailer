<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\HeaderInterface;
use CL\Mailer\ResolvedMessage;
use PHPUnit\Framework\TestCase;

class ResolvedMessageTest extends TestCase
{
    /**
     * @test
     */
    public function its_getters_return_the_expected_values()
    {
        $header = $this->prophesize(HeaderInterface::class)->reveal();
        $body = $this->prophesize(BodyInterface::class)->reveal();

        $resolvedMessage = new ResolvedMessage($header, $body);

        $this->assertSame($header, $resolvedMessage->getHeader());
        $this->assertSame($body, $resolvedMessage->getBody());
    }
}
