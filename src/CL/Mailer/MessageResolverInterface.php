<?php

declare(strict_types=1);

namespace CL\Mailer;

interface MessageResolverInterface
{
    /**
     * @param TypeInterface $type
     * @param array         $options
     *
     * @return ResolvedMessageInterface
     */
    public function resolve(TypeInterface $type, array $options): ResolvedMessageInterface;
}
