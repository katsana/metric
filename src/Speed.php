<?php

namespace Katsana\Metric;

use InvalidArgumentException;

class Speed
{
    /**
     * Speed value in KNOT.
     *
     * @var float
     */
    protected $value;

    /**
     * Construct a new Speed from KNOT.
     *
     * @param float $value
     */
    public function __construct(float $value)
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
    public function humanize(string $format = 'kmh'): float
    {
        $value = \is_numeric($this->value) ? $this->value : 0;

        switch ($format) {
            case 'kmh':
                return \round($value * 1.85200, 2);
            case 'mph':
                return \round($value * 1.15078, 2);
            default:
                throw new InvalidArgumentException("Unvalid given {$format} format.");
        }
    }
}
