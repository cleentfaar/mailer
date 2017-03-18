# Events

### `EVENT_TYPE_BUILT`
If you use the default `Mailer` class, but would like to make some modifications
to messages - after they have been built, but before they have been sent - you can listen to the `EVENT_TYPE_BUILT` event.

For example, you could create your own `TemplatingPart` that your types can then add to your messages,
but you want them to be rendered by your templating system first, before sending the actual message.

```php
<?php

namespace Acme\Mailer\Message\Part;

class TemplatingPart implements PartInterface
{
    /**
     * @param string $path
     * @param array  $variables
     */
    public function __construct(string $path, array $variables)
    {
        $this->path = $path;
        $this->variables = $variables;
    }
    
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * @return array 
     */
    public function getVariables()
    {
        return $this->variables;
    }
}
```

Now, we need to create a listener that listens to the `EVENT_TYPE_BUILT` event mentioned above:

```php
<?php

namespace Acme\EventListener;

use Acme\Mailer\Message\Part\TemplatePart;
use CL\Mailer\Event\TypeBuiltEvent;
use Symfony\Component\Templating\EngineInterface;

class MailerTemplatingListener
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param TypeBuiltEvent $event
     */
    public function onTypeBuilt(TypeBuiltEvent $event)
    {
        foreach ($event->getBuilder()->getParts() as $part) {
            if ($part instanceof TemplatingPart) {
                $part->replaceContent(
                    $this->templating->render($part->getPath(), $part->getVariables())
                );
            }
        }
    }
}

```

### Add the listener to an event dispatcher

Now we need to make sure this listener is registered with an `EventDispatcher` of your choice, 
and pass it to our `Mailer` instance to be used throughout your application:

```php
<?php
// # bootstrap.php
$eventDispatcher = new EventDispatcher();
$eventDispatcher->addListener(Events::EVENT_TYPE_BUILT, new MailerTemplatingListener());
```

### Pass the dispatcher to the `Mailer` instance

```php
<?php
// # bootstrap.php
// pass the dispatcher to the Mailer class
$mailer = new Mailer(
    $typeRegistry,
    $driver,
    $eventDispatcher
);
```

Now, in your scripts, whenever you use the mailer your listener will be triggered 
and convert every `TemplatingPart` to one rendered by your templating system!

```php
<?php
$mailer->send(DemoType::class); // EVENT_TYPE_BUILT dispatched!

```
