<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

class MessageHeader implements MessageHeaderInterface
{
    /**
     * @var Address[]
     */
    private $from = [];

    /**
     * @var Address[]
     */
    private $to = [];

    /**
     * @var Address[]
     */
    private $cc = [];

    /**
     * @var Address[]
     */
    private $bcc = [];

    /**
     * @var Address[]
     */
    private $replyTo = [];

    /**
     * @var string|null
     */
    private $subject;

    /**
     * @inheritdoc
     */
    public function addFrom(Address $address)
    {
        $this->from[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function addTo(Address $address)
    {
        $this->to[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function addCc(Address $address)
    {
        $this->cc[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function addBcc(Address $address)
    {
        $this->bcc[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function addReplyTo(Address $address)
    {
        $this->replyTo[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function setSubject(string $subject = null)
    {
        $this->subject = $subject;
    }
}
