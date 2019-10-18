<?php

namespace Katsana\Metric\Tests;

use Katsana\Metric\Speed;
use PHPUnit\Framework\TestCase;

class SpeedTest extends TestCase
{
    /** @test */
    public function it_can_convert_speed_from_knot_to_kmh()
    {
        $this->assertSame(111.12, (new Speed(60))->humanize());
        $this->assertSame(126.16, (new Speed(68.12))->humanize());
        $this->assertSame(2.22, (new Speed(1.2))->humanize());
        $this->assertSame(0.0, (new Speed(0))->humanize());

        $this->assertSame(111.12, (new Speed('60'))->humanize());
        $this->assertSame(126.16, (new Speed('68.12'))->humanize());
        $this->assertSame(2.22, (new Speed('1.2'))->humanize());
        $this->assertSame(0.0, (new Speed('0'))->humanize());
    }

    /** @test */
    public function it_can_convert_speed_from_knot_to_mph()
    {
        $this->assertSame(69.05, (new Speed(60))->humanize('mph'));
        $this->assertSame(78.39, (new Speed(68.12))->humanize('mph'));
        $this->assertSame(1.38, (new Speed(1.2))->humanize('mph'));
        $this->assertSame(0.0, (new Speed(0))->humanize('mph'));

        $this->assertSame(69.05, (new Speed('60'))->humanize('mph'));
        $this->assertSame(78.39, (new Speed('68.12'))->humanize('mph'));
        $this->assertSame(1.38, (new Speed('1.2'))->humanize('mph'));
        $this->assertSame(0.0, (new Speed('0'))->humanize('mph'));
    }
}
