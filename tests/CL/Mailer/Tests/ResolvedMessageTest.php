<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Message\Address;
use CL\Mailer\Message\Attachment\FileAttachment;
use CL\Mailer\Message\Part\PlainTextPart;
use CL\Mailer\MessageBuilder;
use CL\Mailer\ResolvedMessage;
use CL\Mailer\ResolvedMessageInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

class ResolvedMessageTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_constructed_from_a_message_builder()
    {
        $builder = new MessageBuilder();
        $builder->setSender($sender = new Address('sender@example.com', 'John Sender'));
        $builder->addFrom($from = new Address('from@example.com', 'John From'));
        $builder->addTo($to = new Address('to@example.com', 'John To'));
        $builder->addReplyTo($replyTo = new Address('replyto@example.com', 'John ReplyTo'));
        $builder->setSubject($subject = 'Hello, world!');
        $builder->addPart($part = new PlainTextPart('How are you doing today?'));
        $builder->addAttachment($attachment = new FileAttachment($this->prophesize(File::class)->reveal()));

        $resolvedMessage = ResolvedMessage::fromBuilder($builder);

        $this->assertInstanceOf(ResolvedMessageInterface::class, $resolvedMessage);
        $this->assertSame($sender, $resolvedMessage->getSender());
        $this->assertSame([$from], $resolvedMessage->getFrom());
        $this->assertSame([$to], $resolvedMessage->getTo());
        $this->assertSame([$replyTo], $resolvedMessage->getReplyTo());
        $this->assertSame($subject, $resolvedMessage->getSubject());
        $this->assertSame([$part], $resolvedMessage->getParts());
        $this->assertSame([$attachment], $resolvedMessage->getAttachments());
    }
}
