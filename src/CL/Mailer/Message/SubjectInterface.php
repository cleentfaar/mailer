<?php

namespace CL\Mailer\Message;

interface SubjectInterface
{
    /**
     * @return string
     */
    public function getContent(): string;
}