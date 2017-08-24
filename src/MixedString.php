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

    private $length;

    /**
     *
     * @param string|null $value
     *
     * @throws InvalidArgumentException
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidArgumentException('Value is not valid mixed string.');
        }

        $this->value = $value ? trim($value) : $value;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getLength()
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
    public function isLength($length)
    {
        return $this->getLength() === $length;
    }

    /**
     * @param int $length
     *
     * @return bool
     */
    public function isLengthLongerThan($length)
    {
        return $length < $this->getLength();
    }

    /**
     * @param int $length
     *
     * @return bool
     */
    public function isLengthShorterThan($length)
    {
        return $length > $this->getLength();
    }

    /**
     * @return string|null
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     *
     * @return bool
     */
    private function isValid($value)
    {
        return (is_string($value) || is_null($value));
    }
}
