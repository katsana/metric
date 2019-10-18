<?php

namespace Katsana\Metric;

abstract class Metric
{
    /**
     * Value.
     *
     * @var float|int
     */
    protected $value;

    /**
     * Value format.
     *
     * @var string
     */
    protected $format;

    /**
     * List of supported formats.
     *
     * @var array
     */
    protected $supportedFormats = [];

    /**
     * Format as string.
     *
     * @return string
     */
    public function __toString()
    {
        return \number_format($this->humanize($this->format), 0, '.', ',');
    }

    /**
     * Convert to new format.
     *
     * @param  string $format
     * @return static
     */
    abstract public function to(string $format);

    /**
     * Convert to humanize.
     *
     * @param  string $format
     * @return float|int
     *
     * @throws \InvalidArgumentException
     */
    abstract public function humanize(string $format);

    /**
     * Convert value to.
     *
     * @param  float|int $value
     * @param  string $format
     * @param  string $type
     * @return float|int
     */
    protected function convertTo($value, string $format, string $type = 'from')
    {
        if (! \array_key_exists($format, $this->supportedFormats)) {
            throw new InvalidArgumentException("Unvalid use unsupported {$format} format.");
        }

        $conversion = $this->supportedFormats[$format];

        return ($value * $conversion[$type]);
    }
}
