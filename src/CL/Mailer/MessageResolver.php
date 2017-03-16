<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\Body;
use CL\Mailer\Message\Header;
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

        $header = new Header();
        $body = new Body();

        $type->buildHeader($header, $this->translator, $options);
        $type->buildBody($body, $this->templating, $options);

        return ResolvedMessage::fromHeaderAndBody($header, $body);
    }
}
