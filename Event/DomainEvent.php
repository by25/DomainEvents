<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

declare(strict_types=1);

namespace Itmedia\DomainEvents\Event;

interface DomainEvent
{
    /**
     * Domain event name
     * @return string
     */
    public function getName(): string;
}
