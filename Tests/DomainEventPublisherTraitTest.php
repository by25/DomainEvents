<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Tests;

use Itmedia\DomainEvents\Tests\Stub\Publisher;
use PHPUnit\Framework\TestCase;

class DomainEventPublisherTraitTest extends TestCase
{
    public function testPublisher()
    {
        $publisher = new Publisher();

        $publisher->generateEvent('test');
        $publisher->generateEvent('test');

        $events = $publisher->releaseEvents();
        self::assertCount(2, $events);


        $events = $publisher->releaseEvents();
        self::assertCount(0, $events);
    }
}
