Domain Events
=============

Domain Events Implementation 

Install
-------

`composer require itmedia/domain-events`


How to use
----------


DomainEvent:

```php
<?php

use Itmedia\DomainEvents\Event\DomainEvent;

class AccountRegistrationEvent extends DomainEvent
{
    /**
     * @var Account
     */
    private $account;


    public function __construct(Account $account)
    {
        $this->account = $account;
    }


    public function getName()
    {
        return 'account_register';
    }

    // ...

}

```


Entity implement interface `DomainEventPublisher` :

```php
<?php

use Itmedia\DomainEvents\Publisher\DomainEventPublisher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisherTrait;

class Account implements DomainEventPublisher
{
    use DomainEventPublisherTrait; // Helper trait

    public static function register($email)
    {
        $account = new self();

        //...

        $account->pushEvent(new AccountRegistrationEvent($account));

        return $account;
    }


}

```


Use Doctrine ORM and Symfony events
-----------------------------------

Translation domain-event to symfony events on Doctrine postFlush() action:

```yml

# services.yml

services:

    app.domain_events_translator_handler:
        class: Itmedia\DomainEvents\Bridge\SymfonyDomainEventTranslatorDispatcher
        arguments: ["@event_dispatcher", "@monolog.logger", "%kernel.debug%"]


    # Handle domain-events
    app.doctrine_handler:
        class: Itmedia\DomainEvents\Bridge\DoctrineDomainEventsHandler
        arguments: ["@app.domain_events_translator_handler"]
        tags:
            - { name: doctrine.event_listener, event: postFlush }


```


