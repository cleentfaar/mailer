<?php

declare(strict_types=1);

namespace CL\Mailer\Tests;

use CL\Mailer\Message\Address;
use CL\Mailer\Message\Attachment\AttachmentInterface;
use CL\Mailer\Message\Part\PartInterface;
use CL\Mailer\MessageBuilder;
use PHPUnit\Framework\TestCase;

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
    public function it_can_return_the_expected_sender()
    {
        $this->builder->setSender($sender = new Address('from2@example.com', 'From Doe 1'));

        $this->assertSame($sender, $this->builder->getSender());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_from_addresses()
    {
        $this->builder->addFrom($from1 = new Address('from2@example.com', 'From Doe 1'));
        $this->builder->addFrom($from2 = new Address('from2@example.com', 'From Doe 2'));

        $this->assertSame([$from1, $from2], $this->builder->getFrom());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_to_addresses()
    {
        $this->builder->addTo($to1 = new Address('to1@example.com', 'To Doe 1'));
        $this->builder->addTo($to2 = new Address('to2@example.com', 'To Doe 2'));

        $this->assertSame([$to1, $to2], $this->builder->getTo());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_cc_addresses()
    {
        $this->builder->addCc($cc1 = new Address('cc1@example.com', 'Cc Doe 1'));
        $this->builder->addCc($cc2 = new Address('cc2@example.com', 'Cc Doe 2'));

        $this->assertSame([$cc1, $cc2], $this->builder->getCc());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_bcc_addresses()
    {
        $this->builder->addBcc($bcc1 = new Address('bcc1@example.com', 'Bcc Doe 1'));
        $this->builder->addBcc($bcc2 = new Address('bcc2@example.com', 'Bcc Doe 2'));

        $this->assertSame([$bcc1, $bcc2], $this->builder->getBcc());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_reply_to_addresses()
    {
        $this->builder->addReplyTo($replyTo1 = new Address('reply_to1@example.com', 'Reply To Doe 1'));
        $this->builder->addReplyTo($replyTo2 = new Address('reply_to2@example.com', 'Reply To Doe 2'));

        $this->assertSame([$replyTo1, $replyTo2], $this->builder->getReplyTo());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_subject()
    {
        $this->builder->setSubject($subject = 'This is the subject');

        $this->assertSame($subject, $this->builder->getSubject());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_parts()
    {
        $part = $this->prophesize(PartInterface::class)->reveal();

        $this->builder->addPart($part);

        $this->assertSame([$part], $this->builder->getParts());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_attachments()
    {
        $attachment = $this->prophesize(AttachmentInterface::class)->reveal();

        $this->builder->addAttachment($attachment);

        $this->assertSame([$attachment], $this->builder->getAttachments());
    }
}
