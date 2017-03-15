<?php

namespace CL\Mailer;

use CL\Mailer\Message\ResolvedBodyInterface;
use CL\Mailer\Message\ResolvedHeaderInterface;

interface ResolvedMessageInterface
{
    /**
     * @return ResolvedHeaderInterface
     */
    public function getHeader(): ResolvedHeaderInterface;

    /**
     * @return ResolvedBodyInterface
     */
    public function getBody(): ResolvedBodyInterface;
}