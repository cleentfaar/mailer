# Getting started

Let's say our company name is Acme and we want to send
a welcome email to any user signing up on our website.

### Creating a type

First, we create class implementing `TypeInterface`, or in our (simplified) case, extend `AbstractType`:

```php
<?php
    
namespace AppBundle\Mailer\Type;

use CL\Mailer\Message\Address;
use CL\Mailer\Message\Part\HtmlPart;
use CL\Mailer\Message\Part\PlainTextPart;
use CL\Mailer\MessageBuilderInterface;
use CL\Mailer\TypeInterface;

class DemoType implements TypeInterface
{
    /**
     * @inheritdoc
     */
    public function buildMessage(MessageBuilderInterface $builder, array $options)
    {
        $builder->setSender(new Address('support@acme.com', 'Acme Support'));
        $builder->addTo(new Address('john@doe.com', 'John Doe'));
        $builder->setSubject('Welcome to Acme!');
        $builder->addPart(new HtmlPart('<h1>Welcome!</h1><p>Acme welcomes you!</p>'));
        $builder->addPart(new PlainTextPart('Welcome! Acme welcomes you!'));
    }
}

```

### Send an email using your type

Having created our type, we want to send it using a driver of our choice.
In theory, you could do all that yourself, by simply creating a class 
that implements `MailerInterface`.

But, with some additional bootstrapping,  you can make sending many 
different types of emails easy.

To do this we will use the `Mailer` class supplied by this library that combines 
all of this logic for you so you can use it throughout your application:

```php
<?php

use CL\Mailer\Mailer;
use CL\Mailer\Driver\SwiftmailerDriver;
use CL\Mailer\TypeRegistry;
use Acme\Mailer\Type\DemoType;

// bootstrapping; only need to do this once in your application
$registry = new TypeRegistry();
$registry->register(new DemoType());
// $registry->register(...);
// $registry->register(...);

$driver = new SwiftmailerDriver();
$mailer = new Mailer($registry, $driver);

// actual usage in your scripts:
$mailer->send(DemoType::class);
```

>**NOTE:** The example above uses the `SwiftmailerDriver`, supplied by the [mailer-swiftmailer](https://github.com/cleentfaar/mailer-swiftmailer) package. 
You are of course free to choose your own driver as long as it implements `DriverInterface`.


### Configuring options

This is all nice and well but, if you look at the type class we 
created earlier, we hardcoded the destination address:

```php
// ...

$builder->addTo(new Address('john@doe.com', 'John Doe'));

// ...
```

If you think about it, this is pretty useless for a welcome mail,
we don't want to send the message to the same address everytime!

Instead we want the destination address to be dynamic. This is where options come into play.

Let's implement another method in our type class, namely `configureOptions`:

```php
<?php
    
namespace AppBundle\Mailer\Type;

use CL\Mailer\Message\Address;
use CL\Mailer\MessageBuilderInterface;
use CL\Mailer\TypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemoType implements TypeInterface
{
    /**
     * @inheritdoc
     */
    public function buildMessage(MessageBuilderInterface $builder, array $options)
    {
        // ...
        $builder->addTo($options['to']);
        // ...
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setRequired([
            'to',
        ]);

        $optionsResolver->setAllowedTypes('to', Address::class);
    }
}
```

#### The OptionsResolver
If the above seems alien to you, you might want to get yourself familiar with the [OptionsResolver](https://github.com/symfony/options-resolver) package first.
To summarize, the changes made above make sure that whenever your `Mailer` class sends a message, it must have this `to` option passed along with it.

### Done!
That's it, all that's left is to update your code to use the new `to` option:
```php
// before...
$mailer->send(DemoType::class);

// after...
$mailer->send(DemoType::class, [
    'to' => new Address($user->getEmail(), $user->getName())
]);
```