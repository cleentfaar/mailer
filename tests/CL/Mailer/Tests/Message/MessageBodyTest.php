<?php

declare(strict_types=1);

namespace CL\Mailer\Tests\Message;

use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\MessageBody;
use CL\Mailer\Message\Part\PartInterface;
use PHPUnit\Framework\TestCase;

class MessageBodyTest extends TestCase
{
    /**
     * @var MessageBody
     */
    private $body;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->body = new MessageBody();
    }

    /**
     * @test
     */
    public function it_can_build_a_complete_message()
    {
        $part = $this->prophesize(PartInterface::class)->reveal();
        $attachment = $this->prophesize(AttachmentInterface::class)->reveal();

        $this->body->addPart($part);
        $this->body->addAttachment($attachment);

        $this->assertSame([$part], $this->body->getParts());
        $this->assertSame([$attachment], $this->body->getAttachments());
    }
}
