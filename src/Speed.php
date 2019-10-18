<?php

namespace Katsana\Metric;

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
     * Convert to KM/H.
     *
     * @return int
     */
    public function toKmh(): int
    {
        return \is_numeric($this->value) ? $this->value * 1.85200 : 0;
    }
}
