<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

class ResolvedMessage
{
    /**
     * @var MessageHeaderInterface
     */
    private $messageHeader;

    /**
     * @var MessageBodyInterface
     */
    private $messageBody;

    /**
     * @param MessageHeaderInterface $messageHeader
     * @param MessageBodyInterface   $messageBody
     */
    public function __construct(
        MessageHeaderInterface $messageHeader,
        MessageBodyInterface $messageBody
    ) {
        $this->messageHeader = $messageHeader;
        $this->messageBody = $messageBody;
    }

    /**
     * @return MessageHeaderInterface
     */
    public function getMessageHeader(): MessageHeaderInterface
    {
        return $this->messageHeader;
    }

    /**
     * @return MessageBodyInterface
     */
    public function getMessageBody(): MessageBodyInterface
    {
        return $this->messageBody;
    }
}
