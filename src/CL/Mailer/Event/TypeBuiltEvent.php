<?php

declare(strict_types=1);

namespace CL\Mailer\Event;

use CL\Mailer\MessageBuilderInterface;
use CL\Mailer\TypeInterface;
use Symfony\Component\EventDispatcher\Event;

class TypeBuiltEvent extends Event
{
    /**
     * @var TypeInterface
     */
    private $type;

    /**
     * @var MessageBuilderInterface
     */
    private $builder;

    /**
     * @param TypeInterface           $type
     * @param MessageBuilderInterface $builder
     */
    public function __construct(TypeInterface $type, MessageBuilderInterface $builder)
    {
        $this->type = $type;
        $this->builder = $builder;
    }

    /**
     * @return TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return MessageBuilderInterface
     */
    public function getBuilder(): MessageBuilderInterface
    {
        return $this->builder;
    }
}
