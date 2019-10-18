<?php

namespace Katsana\Metric\Tests;

use Katsana\Metric\Distance;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase
{
    /** @test */
    public function it_can_convert_distance_from_meter_to_km()
    {
        $this->assertSame(60.0, (new Distance(60000))->humanize());
        $this->assertSame(6.81, (new Distance(6812))->humanize());
        $this->assertSame(0.01, (new Distance(12))->humanize());
        $this->assertSame(0.0, (new Distance(0))->humanize());

        $this->assertSame(60.0, (new Distance('60000'))->humanize());
        $this->assertSame(6.81, (new Distance('6812'))->humanize());
        $this->assertSame(0.01, (new Distance('12'))->humanize());
        $this->assertSame(0.0, (new Distance('0'))->humanize());
    }

    /** @test */
    public function it_can_convert_distance_from_meter_to_miles()
    {
        $this->assertSame(37.28, (new Distance(60000))->humanize('mi'));
        $this->assertSame(4.23, (new Distance(6812))->humanize('mi'));
        $this->assertSame(0.01, (new Distance(12))->humanize('mi'));
        $this->assertSame(0.0, (new Distance(0))->humanize('mi'));

        $this->assertSame(37.28, (new Distance('60000'))->humanize('mi'));
        $this->assertSame(4.23, (new Distance('6812'))->humanize('mi'));
        $this->assertSame(0.01, (new Distance('12'))->humanize('mi'));
        $this->assertSame(0.0, (new Distance('0'))->humanize('mi'));
    }
}
