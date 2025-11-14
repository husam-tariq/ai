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

use Symfony\AI\Platform\Metadata\MetadataAwareTrait;
use Symfony\AI\Platform\Result\ToolCall;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Uid\TimeBasedUidInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @author Denis Zunke <denis.zunke@gmail.com>
 */
final class AssistantMessage implements MessageInterface
{
    use MetadataAwareTrait;

    /**
     * @var AbstractUid&TimeBasedUidInterface
     */
    private $id;

    /**
     * @var string|null
     */
    private $content;

    /**
     * @var ToolCall[]|null
     */
    private $toolCalls;

    /**
     * @param string|null $content
     * @param ToolCall[]|null $toolCalls
     */
    public function __construct(?string $content = null, ?array $toolCalls = null)
    {
        $this->content = $content;
        $this->toolCalls = $toolCalls;
        $this->id = Uuid::v7();
    }

    public function getRole(): Role
    {
        return Role::Assistant();
    }

    /**
     * @return AbstractUid&TimeBasedUidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    public function hasToolCalls(): bool
    {
        return null !== $this->toolCalls && [] !== $this->toolCalls;
    }

    /**
     * @return ToolCall[]|null
     */
    public function getToolCalls(): ?array
    {
        return $this->toolCalls;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
