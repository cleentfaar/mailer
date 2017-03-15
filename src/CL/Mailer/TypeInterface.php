<?php

declare(strict_types=1);

namespace CL\Mailer;

use CL\Mailer\Message\BodyInterface;
use CL\Mailer\Message\HeaderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface TypeInterface
{
    /**
     * @param HeaderInterface $builder
     * @param array           $options
     */
    public function buildHeader(HeaderInterface $builder, array $options);

    /**
     * @param BodyInterface $body
     * @param array         $options
     */
    public function buildBody(BodyInterface $body, array $options);

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver);
}
