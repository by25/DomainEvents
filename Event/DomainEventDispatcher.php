<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents;

use Itmedia\DomainEvents\Publisher\DomainEventPublisher;

interface DomainEventDispatcher
{
    public function dispatch(DomainEventPublisher $publisher);
}
