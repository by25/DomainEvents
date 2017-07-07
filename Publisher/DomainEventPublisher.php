<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

declare(strict_types=1);

namespace Itmedia\DomainEvents\Publisher;

use Itmedia\DomainEvents\Event\DomainEvent;

interface DomainEventPublisher
{

    /**
     * Return published domain events
     *
     * @return DomainEvent[]
     */
    public function releaseEvents(): array;
}
