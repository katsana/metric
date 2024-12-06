<?php

namespace Katsana\Metric;

use InvalidArgumentException;

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
     * Serialize the object to a value that can be serialized natively by json_encode().
     *
     * @return array
     */
    public function __serialize(): array
    {
        return [
            'value' => $this->value,
            'format' => $this->format,
        ];
    }

    /**
     * Unserialize the object from a value that was serialized by json_encode().
     *
     * @param array $data
     */
    public function __unserialize(array $data): void
    {
        $this->value = $data['value'];
        $this->format = $data['format'];
    }

    /**
     * @deprecated Use __serialize() instead
     */
    public function serialize()
    {
        return \serialize($this->__serialize());
    }

    /**
     * @deprecated Use __unserialize() instead
     */
    public function unserialize($data)
    {
        $this->__unserialize(\unserialize($data));
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
