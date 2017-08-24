<?php

declare(strict_types=1);

namespace Application\Domain;

use InvalidArgumentException;

final class MixedString
{
    /**
     * @var string|null
     */
    private $value;

    /**
     * @var int|null
     */
    private $length;

    /**
     *
     * @param string|null $value
     *
     * @throws InvalidArgumentException
     */
    public function __construct(?string $value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidArgumentException('Value is not valid mixed string.');
        }

        $this->value = $value ? trim($value) : $value;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        if ($this->length === null) {
            $this->length = mb_strlen($this->value);
        }

        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return bool
     */
    public function isLength(int $length): bool
    {
        return $this->getLength() === $length;
    }

    /**
     * @param int $length
     *
     * @return bool
     */
    public function isLengthLongerThan(int $length): bool
    {
        return $length < $this->getLength();
    }

    /**
     * @param int $length
     *
     * @return bool
     */
    public function isLengthShorterThan(int $length): bool
    {
        return $length > $this->getLength();
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     *
     * @return bool
     */
    private function isValid(?string $value): bool
    {
        return is_string($value) || is_null($value);
    }
}
