<?php

namespace Katsana\Metric;

use InvalidArgumentException;

class Distance
{
    /**
     * Speed value in METER.
     *
     * @var int
     */
    protected $value;

    /**
     * Construct a new Speed from METER.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Convert to humanize.
     *
     * @param  string $format
     * @return float
     * @throws \InvalidArgumentException
     */
    public function humanize(string $format = 'km'): float
    {
        $value = \is_numeric($this->value) ? $this->value : 0;

        switch ($format) {
            case 'km':
                return \round($value * 0.001, 2);
            case 'mi':
                return \round($value * 0.000621371, 2);
            default:
                throw new InvalidArgumentException("Unvalid given {$format} format.");
        }
    }
}
