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
    public function its_getters_return_the_expected_values()
    {
        $part = $this->prophesize(Body\Part\PartInterface::class)->reveal();
        $attachment = $this->prophesize(Body\Attachment\AttachmentInterface::class)->reveal();

        $this->body->setMainPart($part);
        $this->body->addAttachment($attachment);

        $this->assertSame($part, $this->body->getMainPart());
        $this->assertSame([$attachment], $this->body->getAttachments());
    }
}
