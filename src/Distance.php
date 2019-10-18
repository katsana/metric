<?php

namespace Katsana\Metric;

use InvalidArgumentException;

class Distance extends Metric
{
    /**
     * List of supported formats.
     *
     * @var array
     */
    protected $supportedFormats = [
        'm' => [
            'from' => 1,
            'to' => 1,
        ],
        'km' => [
            'from' => 0.001,
            'to' => 1000.0,
        ],
        'mi' => [
            'from' => 0.000621371,
            'to' => 1609.34,
        ],
    ];

    /**
     * Construct a new Speed from METER.
     *
     * @param float $value
     */
    public function __construct(float $value, string $format = 'm')
    {
        $value = \is_numeric($value) ? $value : 0;

        $this->format = $format;
        $this->value = $this->convertTo($value, $format, 'to');
    }

    /**
     * Convert to Speed with new format.
     *
     * @param  string $format
     * @return static
     */
    public function to(string $format = 'km')
    {
        return new static(
            $this->convertTo($this->value, $format, 'from'), $format
        );
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
        return \round(
            $this->convertTo($this->value, $format, 'from'), 2
        );
    }
}
