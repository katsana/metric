<?php

namespace Katsana\Metric\Tests;

use Katsana\Metric\Speed;
use PHPUnit\Framework\TestCase;

class SpeedTest extends TestCase
{
    /** @test */
    public function it_can_convert_speed_from_knot_to_kmh()
    {
        $this->assertSame(111, (new Speed(60))->toKmh());
        $this->assertSame(126, (new Speed(68.12))->toKmh());
        $this->assertSame(2, (new Speed(1.2))->toKmh());
        $this->assertSame(0, (new Speed(0))->toKmh());

        $this->assertSame(111, (new Speed('60'))->toKmh());
        $this->assertSame(126, (new Speed('68.12'))->toKmh());
        $this->assertSame(2, (new Speed('1.2'))->toKmh());
        $this->assertSame(0, (new Speed('0'))->toKmh());
    }
}
