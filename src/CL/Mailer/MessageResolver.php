<?php

declare(strict_types=1);

namespace CL\Mailer;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class MessageResolver implements MessageResolverInterface
{
    /**
     * @var TypeRegistryInterface
     */
    private $typeRegistry;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @param TypeRegistryInterface $typeRegistry
     * @param TranslatorInterface   $translator
     * @param EngineInterface       $templating
     */
    public function __construct(
        TypeRegistryInterface $typeRegistry,
        TranslatorInterface $translator,
        EngineInterface $templating
    ) {
        $this->typeRegistry = $typeRegistry;
        $this->translator = $translator;
        $this->templating = $templating;
    }

    /**
     * @inheritdoc
     */
    public function resolve(string $type, array $options): ResolvedMessageInterface
    {
        $resolver = new OptionsResolver();

        $type = $this->typeRegistry->get($type);
        $type->configureOptions($resolver);

        $options = $resolver->resolve($options);
        $builder = new MessageBuilder();

        $type->buildMessage($builder, $this->translator, $this->templating, $options);

        return $this->resolveFromBuilder($builder);
    }

    /**
     * Creates a resolved message from a given builder.
     *
     * This method can be used to make generic changes to all messages sent through this resolver
     *
     * @param MessageBuilderInterface $builder
     *
     * @return ResolvedMessageInterface
     */
    protected function resolveFromBuilder(MessageBuilderInterface $builder) : ResolvedMessageInterface
    {
        return ResolvedMessage::fromBuilder($builder);
    }
}
