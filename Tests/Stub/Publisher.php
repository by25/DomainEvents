<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Tests\Stub;

use Itmedia\DomainEvents\Event\DomainEvent;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisherTrait;

class Publisher implements DomainEventPublisher
{
    use DomainEventPublisherTrait;


    public function onSingleEvent(DomainEvent $domainEvent)
    {
        $this->pushSingleEvent($domainEvent);
    }


    public function onEvent(DomainEvent $domainEvent)
    {
        $this->pushEvent($domainEvent);
    }

}
