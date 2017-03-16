<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\HeaderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

interface TypeInterface
{
    /**
     * @param HeaderInterface     $builder
     * @param TranslatorInterface $translator
     * @param array               $options
     */
    public function buildHeader(HeaderInterface $builder, TranslatorInterface $translator, array $options);

    /**
     * @param BodyInterface   $body
     * @param EngineInterface $templating
     * @param array           $options
     */
    public function buildBody(BodyInterface $body, EngineInterface $templating, array $options);

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver);
}
