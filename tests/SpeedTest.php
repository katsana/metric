<?php

namespace Katsana\Metric\Tests;

use Katsana\Metric\Speed;
use PHPUnit\Framework\TestCase;

class SpeedTest extends TestCase
{
    /** @test */
    public function it_can_display_formatted_speed()
    {
        $this->assertSame('111', (string) (new Speed(60))->to('kmh'));
        $this->assertSame('126', (string) (new Speed(68.12))->to('kmh'));
        $this->assertSame('2', (string) (new Speed(1.2))->to('kmh'));
        $this->assertSame('0', (string) (new Speed(0))->to('kmh'));
        $this->assertSame('0', (string) (new Speed(null))->to('kmh'));
    }

    /** @test */
    public function it_can_convert_speed_from_knot_to_kmh()
    {
        $this->assertSame(111.12, (new Speed(60))->humanize('kmh'));
        $this->assertSame(126.16, (new Speed(68.12))->humanize('kmh'));
        $this->assertSame(2.22, (new Speed(1.2))->humanize('kmh'));
        $this->assertSame(0.0, (new Speed(0))->humanize('kmh'));
    }

    /** @test */
    public function it_can_convert_speed_from_knot_to_mph()
    {
        $this->assertSame(69.05, (new Speed(60))->humanize('mph'));
        $this->assertSame(78.39, (new Speed(68.12))->humanize('mph'));
        $this->assertSame(1.38, (new Speed(1.2))->humanize('mph'));
        $this->assertSame(0.0, (new Speed(0))->humanize('mph'));
    }

    /** @test */
    public function it_can_convert_speed_from_knot_to_mph_via_kmh()
    {
        $this->assertSame(69.05, (new Speed(60))->to('kmh')->humanize('mph'));
        $this->assertSame(78.39, (new Speed(68.12))->to('kmh')->humanize('mph'));
        $this->assertSame(1.38, (new Speed(1.2))->to('kmh')->humanize('mph'));
        $this->assertSame(0.0, (new Speed(0))->to('kmh')->humanize('mph'));
    }

    /** @test */
    public function it_can_serialize_speed()
    {
        $this->assertSame(
            'O:20:"Katsana\Metric\Speed":2:{s:5:"value";d:48.59613;s:6:"format";s:3:"kmh";}',
            \serialize(new Speed(90, 'kmh'))
        );
    }

    /** @test */
    public function it_can_unserialize_speed()
    {
        $speed = \unserialize(
            'C:20:"Katsana\Metric\Speed":52:{a:2:{s:5:"value";d:48.59613;s:6:"format";s:3:"kmh";}}'
        );

        $this->assertSame(90.0, $speed->humanize());
    }
}
