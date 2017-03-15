<?php

namespace CL\Mailer;

interface MessageResolverInterface
{
    /**
     * @param string $type
     * @param array  $options
     *
     * @return ResolvedMessageInterface
     */
    public function resolve(string $type, array $options): ResolvedMessageInterface;
}