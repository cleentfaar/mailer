<?php

namespace CL\Mailer\Message;

class Subject implements SubjectInterface
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @param string $subject
     */
    public function __construct(string $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->subject;
    }
}