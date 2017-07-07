<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

declare(strict_types=1);

namespace Itmedia\DomainEvents\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Abstract DomainEvent
 */
abstract class DomainEvent extends Event
{
    /**
     * Domain event name
     *
     * @return string
     */
    abstract public function getName(): string;
}
