<?php

declare(strict_types=1);

namespace Application\Domain\Person\AbstractType;

use Application\Domain\MixedString;
use InvalidArgumentException;

abstract class FirstNameAbstract
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 60;

    /** @var MixedString  */
    private $value;

    /**
     * FirstNameAbstract constructor.
     * @param MixedString $value
     */
    public function __construct(MixedString $value)
    {
        $this->isValid($value);

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @param MixedString $value
     */
    private function isValid(MixedString $value): void
    {
        if (!$value->getValue()) {
            throw new InvalidArgumentException('First name cannot by null');
        }
        if ($value->isLengthShorterThan(self::MIN_LENGTH)) {
            throw new InvalidArgumentException('First name is to short');
        }
        if ($value->isLengthLongerThan(self::MAX_LENGTH)) {
            throw new InvalidArgumentException('First name is to long');
        }
    }
}