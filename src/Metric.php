<?php

namespace Katsana\Metric;

use InvalidArgumentException;
use Serializable;

abstract class Metric implements Serializable
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
     * Convert to humanize.
     *
     * @throws \InvalidArgumentException
     */
    public function humanize(?string $format = null): float
    {
        return \round(
            $this->convertTo($this->value, $format ?? $this->format, 'from'), 2
        );
    }

    /**
     * Format as string.
     *
     * @return string
     */
    public function __toString()
    {
        return \number_format($this->humanize(), 0, '.', ',');
    }

    /**
     * Serialize instance.
     *
     * @return string
     */
    public function serialize()
    {
        return \serialize([
            'value' => $this->value,
            'format' => $this->format,
        ]);
    }

    /**
     * Unserialize instance.
     *
     * @param string $data
     *
     * @return void
     */
    public function unserialize($data)
    {
        [
            'value' => $this->value,
            'format' => $this->format,
        ] = \unserialize($data);
    }

    /**
     * Convert to new format.
     *
     * @return static
     */
    abstract public function to(string $format);

    /**
     * Convert value to.
     *
     * @param float|int $value
     *
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
