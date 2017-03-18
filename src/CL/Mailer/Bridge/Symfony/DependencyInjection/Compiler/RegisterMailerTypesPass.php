<?php

declare(strict_types=1);

namespace CL\Mailer\Bridge\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Compiler pass that can be used to register mail types
 * with the tag and registry of your choice.
 */
class RegisterMailerTypesPass implements CompilerPassInterface
{
    /**
     * @var string
     */
    private $tagName;

    /**
     * @var string
     */
    private $typeRegistryServiceId;

    /**
     * @param string $tagName
     * @param string $typeRegistryServiceId
     */
    public function __construct(string $tagName, string $typeRegistryServiceId)
    {
        $this->tagName = $tagName;
        $this->typeRegistryServiceId = $typeRegistryServiceId;
    }

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has($this->typeRegistryServiceId)) {
            return;
        }

        $definition = $container->findDefinition($this->typeRegistryServiceId);

        $taggedServices = $container->findTaggedServiceIds($this->tagName);

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('register', [new Reference($id)]);
        }
    }
}
