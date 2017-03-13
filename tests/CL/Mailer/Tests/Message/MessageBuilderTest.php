<?php

namespace CL\Mailer\Tests\Message;

use CL\Mailer\Message\Attachment\FileAttachment;
use CL\Mailer\Message\MessageBuilder;
use CL\Mailer\Message\Address;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

class MessageBuilderTest extends TestCase
{
    /**
     * @var MessageBuilder
     */
    private $builder;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->builder = new MessageBuilder();
    }

    /**
     * @test
     */
    public function it_can_build_a_complete_message()
    {
        $this->builder->setSubject($subject = 'This is the subject');
        $this->builder->addFrom($from = new Address('from@example.com', 'From Doe'));
        $this->builder->addTo($to = new Address('to@example.com', 'To Doe'));
        $this->builder->addCc($cc = new Address('cc@example.com', 'Cc Doe'));
        $this->builder->addBcc($bcc = new Address('bcc@example.com', 'Bcc Doe'));
        $this->builder->addReplyTo($replyTo = new Address('replyto@example.com', 'Reply To Doe'));
        $this->builder->addAttachment($attachment = new FileAttachment(new File('/path/to/attachment.txt', false)));

        $this->assertSame($subject, $this->builder->getSubject());
        $this->assertSame([$from], $this->builder->getFrom());
        $this->assertSame([$to], $this->builder->getTo());
        $this->assertSame([$cc], $this->builder->getCc());
        $this->assertSame([$bcc], $this->builder->getBcc());
        $this->assertSame([$replyTo], $this->builder->getReplyTo());
        $this->assertSame([$attachment], $this->builder->getAttachments());
    }
}