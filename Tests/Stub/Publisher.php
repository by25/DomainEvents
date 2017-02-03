<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Tests\Stub;

use Itmedia\DomainEvents\Event\DefaultDomainEvent;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisherTrait;

class Publisher implements DomainEventPublisher
{
    use DomainEventPublisherTrait;


    public function generateEvent($nameEvent)
    {
        $this->pushEvent(new DefaultDomainEvent($nameEvent, null));
    }

}