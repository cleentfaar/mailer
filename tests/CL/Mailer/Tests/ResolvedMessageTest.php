<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Message\Address;
use CL\Mailer\MessageBuilder;
use CL\Mailer\ResolvedMessage;
use CL\Mailer\ResolvedMessageInterface;
use PHPUnit\Framework\TestCase;

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

        $resolvedMessage = ResolvedMessage::fromBuilder($builder);

        $this->assertInstanceOf(ResolvedMessageInterface::class, $resolvedMessage);
        $this->assertSame($sender, $resolvedMessage->getSender());
        $this->assertSame([$from], $resolvedMessage->getFrom());
        $this->assertSame([$to], $resolvedMessage->getTo());
        $this->assertSame([$replyTo], $resolvedMessage->getReplyTo());
    }
}
