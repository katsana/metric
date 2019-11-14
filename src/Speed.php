<?php

namespace Katsana\Metric;

class Speed extends Metric
{
    /**
     * List of supported formats.
     *
     * @var array
     */
    protected $supportedFormats = [
        'kn' => [
            'from' => 1,
            'to' => 1,
        ],
        'kmh' => [
            'from' => 1.85200,
            'to' => 0.539957,
        ],
        'mph' => [
            'from' => 1.15078,
            'to' => 0.868976,
        ],
    ];

    /**
     * Construct a new Speed.
     */
    public function __construct(float $value, string $format = 'kn')
    {
        $value = \is_numeric($value) ? $value : 0;

        $this->format = $format;
        $this->value = $this->convertTo($value, $format, 'to');
    }

    /**
     * Convert to Speed with new format.
     *
     * @return static
     */
    public function to(string $format = 'kmh')
    {
        return new static(
            $this->convertTo($this->value, $format, 'from'), $format
        );
    }
}
