<?php

namespace Katsana\Metric\Tests;

use Katsana\Metric\Distance;
use Katsana\Metric\Metric;
use PHPUnit\Framework\TestCase;

class DistanceTest extends TestCase
{
    /** @test */
    public function it_can_display_formatted_distance()
    {
        $this->assertSame('60', (string) (new Distance(60000))->to('km'));
        $this->assertSame('7', (string) (new Distance(6812))->to('km'));
        $this->assertSame('0', (string) (new Distance(12))->to('km'));
        $this->assertSame('0', (string) (new Distance(0))->to('km'));
        $this->assertSame('0', (string) (new Distance(null))->to('km'));
    }

    /** @test */
    public function it_can_convert_distance_from_meter_to_km()
    {
        $this->assertSame(60.0, (new Distance(60000))->humanize('km'));
        $this->assertSame(6.81, (new Distance(6812))->humanize('km'));
        $this->assertSame(0.01, (new Distance(12))->humanize('km'));
        $this->assertSame(0.0, (new Distance(0))->humanize('km'));
    }

    /** @test */
    public function it_can_convert_distance_from_meter_to_miles()
    {
        $this->assertSame(37.28, (new Distance(60000))->humanize('mi'));
        $this->assertSame(4.23, (new Distance(6812))->humanize('mi'));
        $this->assertSame(0.01, (new Distance(12))->humanize('mi'));
        $this->assertSame(0.0, (new Distance(0))->humanize('mi'));
    }

    /** @test */
    public function it_can_convert_distance_from_meter_to_miles_via_km()
    {
        $this->assertSame(37.28, (new Distance(60000))->to('km')->humanize('mi'));
        $this->assertSame(4.23, (new Distance(6812))->to('km')->humanize('mi'));
        $this->assertSame(0.01, (new Distance(12))->to('km')->humanize('mi'));
        $this->assertSame(0.0, (new Distance(0))->to('km')->humanize('mi'));
    }

    /** @test */
    public function it_can_serialize_speed()
    {

        $this->assertSame(
            'O:23:"Katsana\Metric\Distance":2:{s:5:"value";d:90000;s:6:"format";s:2:"km";}',
            serialize(new Distance(90, 'km'))
        );
    }

    /** @test */
    public function it_can_unserialize_speed()
    {
        $distance = \unserialize(
            'C:23:"Katsana\Metric\Distance":48:{a:2:{s:5:"value";d:90000;s:6:"format";s:2:"km";}}'
        );

        $this->assertSame(90.0, $distance->humanize());
    }
}
