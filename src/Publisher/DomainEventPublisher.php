<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Publisher;

use Itmedia\DomainEvents\Event\DomainEvent;

interface DomainEventPublisher
{

    /**
     * Return published domain events
     *
     * @return DomainEvent[]
     */
    public function releaseEvents();
}
