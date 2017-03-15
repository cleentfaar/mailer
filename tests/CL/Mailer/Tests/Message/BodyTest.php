<?php

declare(strict_types=1);

namespace CL\Mailer\Tests\Message;

use CL\Mailer\Message\Body;
use PHPUnit\Framework\TestCase;

class BodyTest extends TestCase
{
    /**
     * @var Body
     */
    private $body;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->body = new Body();
    }

    /**
     * @test
     */
    public function it_can_build_a_complete_message()
    {
        $part = $this->prophesize(Body\Part\PartInterface::class)->reveal();
        $attachment = $this->prophesize(Body\Attachment\AttachmentInterface::class)->reveal();

        $this->body->addPart($part);
        $this->body->addAttachment($attachment);

        $this->assertSame([$part], $this->body->getParts());
        $this->assertSame([$attachment], $this->body->getAttachments());
    }
}
