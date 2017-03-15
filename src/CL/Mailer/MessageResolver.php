<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\Body;
use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\Header;
use CL\Mailer\Message\HeaderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageResolver implements MessageResolverInterface
{
    /**
     * @var TypeRegistryInterface
     */
    private $typeRegistry;

    /**
     * @var string|null
     */
    private $headerClass;

    /**
     * @var string|null
     */
    private $bodyClass;

    /**
     * @param TypeRegistryInterface $typeRegistry
     * @param string|null           $headerClass
     * @param string|null           $bodyClass
     */
    public function __construct(
        TypeRegistryInterface $typeRegistry,
        string $headerClass = null,
        string $bodyClass = null
    ) {
        $headerClass = $headerClass ?: Header::class;
        $bodyClass = $bodyClass ?: Body::class;

        $this->typeRegistry = $typeRegistry;

        if (!in_array(HeaderInterface::class, class_implements($headerClass))) {
            throw new \InvalidArgumentException(sprintf(
                'The given header class (%s) must implement %s',
                $headerClass,
                HeaderInterface::class
            ));
        }

        $this->headerClass = $headerClass;

        if (!in_array(BodyInterface::class, class_implements($bodyClass))) {
            throw new \InvalidArgumentException(sprintf(
                'The given body class (%s) must implement %s',
                $bodyClass,
                BodyInterface::class
            ));
        }

        $this->bodyClass = $bodyClass;
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

        $header = new $this->headerClass();
        $body = new $this->bodyClass();

        $type->buildHeader($header, $options);
        $type->buildBody($body, $options);

        return ResolvedMessage::fromHeaderAndBody($header, $body);
    }
}
