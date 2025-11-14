<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\Store\Bridge\Redis;

/**
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
final class Distance
{
    /** @var string */
    public $value;

    /** @var self|null */
    private static $cosine;
    /** @var self|null */
    private static $l2;
    /** @var self|null */
    private static $ip;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function Cosine(): self
    {
        if (null === self::$cosine) {
            self::$cosine = new self('COSINE');
        }
        return self::$cosine;
    }

    public static function L2(): self
    {
        if (null === self::$l2) {
            self::$l2 = new self('L2');
        }
        return self::$l2;
    }

    public static function Ip(): self
    {
        if (null === self::$ip) {
            self::$ip = new self('IP');
        }
        return self::$ip;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function notEquals(self $other): bool
    {
        return !$this->equals($other);
    }

    /**
     * @param self ...$others
     */
    public function equalsOneOf(self ...$others): bool
    {
        foreach ($others as $other) {
            if ($this->equals($other)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param self ...$others
     */
    public function notEqualsOneOf(self ...$others): bool
    {
        return !$this->equalsOneOf(...$others);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
