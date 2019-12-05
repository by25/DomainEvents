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

class AccountRegistrationEvent implements DomainEvent
{
    /**
     * @var Account
     */
    private $account;


    public function __construct(Account $account)
    {
        $this->account = $account;
    }


    public function getName():string
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
        
        // Checked single event
        $account->pushSingleEvent(new MyEvent($account));
        $account->pushSingleEvent(new MyEvent($account));

        return $account;
    }


}

```


Use Doctrine ORM and Symfony events
-----------------------------------

Translation domain-event to symfony events on Doctrine postFlush() action:

```yaml

# services.yml

services:

    # Translate domain event to symfony events
    Itmedia\DomainEvents\Bridge\SymfonyDomainEventTranslatorDispatcher:
        arguments: ['@event_dispatcher', '@logger', '%kernel.debug%']


    # Handle domain-events
    Itmedia\DomainEvents\Bridge\DoctrineDomainEventsHandler:
        arguments: ['@Itmedia\DomainEvents\Bridge\SymfonyDomainEventTranslatorDispatcher']
        tags:
            - { name: doctrine.event_listener, event: postFlush }
            - { name: doctrine.event_listener, event: preFlush }


```


