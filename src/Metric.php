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
     * Serialize the metric object.
     */
    public function serialize(): string
    {
        return serialize([
            'value' => $this->value,
            'format' => $this->format,
        ]);
    }

    /**
     * Unserialize the metric object.
     */
    public function unserialize($data): void
    {
        $data = unserialize($data);
        $this->value = $data['value'];
        $this->format = $data['format'];
    }

    /**
     * @deprecated Use serialize() instead
     */
    public function __serialize(): array
    {
        return [
            'value' => $this->value,
            'format' => $this->format,
        ];
    }

    /**
     * @deprecated Use unserialize() instead
     */
    public function __unserialize(array $data): void
    {
        $this->value = $data['value'];
        $this->format = $data['format'];
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
