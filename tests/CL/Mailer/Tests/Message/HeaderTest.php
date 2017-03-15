<?php

declare(strict_types=1);

namespace CL\Mailer\Tests\Message;

use CL\Mailer\Message\Header;
use CL\Mailer\Message\Header\Address;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{
    /**
     * @var Header
     */
    private $header;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->header = new Header();
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_subject()
    {
        $this->header->setSubject($subject = 'This is the subject');

        $this->assertSame($subject, $this->header->getSubject());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_from_addresses()
    {
        $this->header->addFrom($from1 = new Address('from2@example.com', 'From Doe 1'));
        $this->header->addFrom($from2 = new Address('from2@example.com', 'From Doe 2'));

        $this->assertSame([$from1, $from2], $this->header->getFrom());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_to_addresses()
    {
        $this->header->addTo($to1 = new Address('to1@example.com', 'To Doe 1'));
        $this->header->addTo($to2 = new Address('to2@example.com', 'To Doe 2'));

        $this->assertSame([$to1, $to2], $this->header->getTo());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_cc_addresses()
    {
        $this->header->addCc($cc1 = new Address('cc1@example.com', 'Cc Doe 1'));
        $this->header->addCc($cc2 = new Address('cc2@example.com', 'Cc Doe 2'));

        $this->assertSame([$cc1, $cc2], $this->header->getCc());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_bcc_addresses()
    {
        $this->header->addBcc($bcc1 = new Address('bcc1@example.com', 'Bcc Doe 1'));
        $this->header->addBcc($bcc2 = new Address('bcc2@example.com', 'Bcc Doe 2'));

        $this->assertSame([$bcc1, $bcc2], $this->header->getBcc());
    }

    /**
     * @test
     */
    public function it_can_return_the_expected_reply_to_addresses()
    {
        $this->header->addReplyTo($replyTo1 = new Address('reply_to1@example.com', 'Reply To Doe 1'));
        $this->header->addReplyTo($replyTo2 = new Address('reply_to2@example.com', 'Reply To Doe 2'));

        $this->assertSame([$replyTo1, $replyTo2], $this->header->getReplyTo());
    }
}
