<?php

declare(strict_types=1);

namespace CL\Mailer\Message;

use CL\Mailer\Type\TypeRegistry;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageResolver
{
    /**
     * @var TypeRegistry
     */
    private $typeRegistry;

    /**
     * @param TypeRegistry $typeRegistry
     */
    public function __construct(
        TypeRegistry $typeRegistry
    ) {
        $this->typeRegistry = $typeRegistry;
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return ResolvedMessage
     */
    public function resolve(string $type, array $options) : ResolvedMessage
    {
        $resolver = new OptionsResolver();

        $type = $this->typeRegistry->get($type);
        $type->configureOptions($resolver);

        $options = $resolver->resolve($options);

        $type->buildHeader($header = new MessageHeader(), $options);
        $type->buildBody($body = new MessageBody(), $options);

        return new ResolvedMessage($header, $body);
    }
}
