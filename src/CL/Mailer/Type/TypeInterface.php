<?php

namespace CL\Mailer\Type;

use CL\Mailer\Message\MessageHeaderInterface;
use CL\Mailer\Message\MessageBody;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface TypeInterface
{
    /**
     * @param MessageHeaderInterface $builder
     * @param array                  $options
     */
    public function buildHeader(MessageHeaderInterface $builder, array $options);

    /**
     * @param MessageBody $view
     * @param array       $options
     */
    public function buildBody(MessageBody $view, array $options);

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver);
}
