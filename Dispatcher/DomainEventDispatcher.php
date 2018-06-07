<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

declare(strict_types=1);

namespace Itmedia\DomainEvents\Dispatcher;

use Itmedia\DomainEvents\Publisher\DomainEventPublisher;

interface DomainEventDispatcher
{
    public function dispatch(DomainEventPublisher $publisher): void;
}
