<?php

declare(strict_types=1);

namespace CL\Mailer;

use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageResolver implements MessageResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(TypeInterface $type, array $options): ResolvedMessageInterface
    {
        $resolver = new OptionsResolver();

        $type->configureOptions($resolver);

        $options = $resolver->resolve($options);
        $builder = new MessageBuilder();

        $type->buildMessage($builder, $options);

        return ResolvedMessage::fromBuilder($builder);
    }
}
