<?php

declare(strict_types=1);

namespace CL\Mailer\Type;

use CL\Mailer\Message\MessageBodyInterface;
use CL\Mailer\Message\MessageHeaderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface TypeInterface
{
    /**
     * @param MessageHeaderInterface $builder
     * @param array                  $options
     */
    public function buildHeader(MessageHeaderInterface $builder, array $options);

    /**
     * @param MessageBodyInterface $body
     * @param array                $options
     */
    public function buildBody(MessageBodyInterface $body, array $options);

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver);
}
