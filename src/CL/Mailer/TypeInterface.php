<?php

declare(strict_types=1);

namespace CL\Mailer;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface TypeInterface
{
    /**
     * @param MessageBuilderInterface $builder
     * @param array                   $options
     */
    public function buildMessage(MessageBuilderInterface $builder, array $options);

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver);
}
