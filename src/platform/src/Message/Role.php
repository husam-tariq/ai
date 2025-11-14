<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\Platform\Message;

/**
 * @author Christopher Hertel <mail@christopher-hertel.de>
 */
final class Role
{
    /** @var string */
    public $value;

    /** @var self|null */
    private static $system;
    /** @var self|null */
    private static $assistant;
    /** @var self|null */
    private static $user;
    /** @var self|null */
    private static $toolCall;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function System(): self
    {
        if (null === self::$system) {
            self::$system = new self('system');
        }
        return self::$system;
    }

    public static function Assistant(): self
    {
        if (null === self::$assistant) {
            self::$assistant = new self('assistant');
        }
        return self::$assistant;
    }

    public static function User(): self
    {
        if (null === self::$user) {
            self::$user = new self('user');
        }
        return self::$user;
    }

    public static function ToolCall(): self
    {
        if (null === self::$toolCall) {
            self::$toolCall = new self('tool');
        }
        return self::$toolCall;
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

// Define static properties that mimic enum cases for backward compatibility
class_alias(Role::class, 'Symfony\AI\Platform\Message\RoleAlias');

