<?php

declare(strict_types=1);

namespace CL\Mailer;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

interface TypeInterface
{
    /**
     * @param MessageBuilderInterface $builder
     * @param TranslatorInterface     $translator
     * @param EngineInterface         $templating
     * @param array                   $options
     */
    public function buildMessage(
        MessageBuilderInterface $builder,
        TranslatorInterface $translator,
        EngineInterface $templating,
        array $options
    );

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver);
}
