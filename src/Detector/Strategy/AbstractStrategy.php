<?php

declare(strict_types=1);

/*
 * This file is part of PHP Copy/Paste Detector (PHPCPD).
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\PHPCPD\Detector\Strategy;

use SebastianBergmann\PHPCPD\CodeCloneMap;

abstract class AbstractStrategy
{
    /**
     * @psalm-var array<int,true>
     */
    protected array $tokensIgnoreList = [
        \T_INLINE_HTML => true,
        \T_COMMENT => true,
        \T_DOC_COMMENT => true,
        \T_OPEN_TAG => true,
        \T_OPEN_TAG_WITH_ECHO => true,
        \T_CLOSE_TAG => true,
        \T_WHITESPACE => true,
        \T_USE => true,
        \T_NS_SEPARATOR => true,
    ];

    protected StrategyConfiguration $config;

    public function __construct(StrategyConfiguration $strategyConfiguration)
    {
        $this->config = $strategyConfiguration;
    }

    public function setConfig(StrategyConfiguration $strategyConfiguration): void
    {
        $this->config = $strategyConfiguration;
    }

    abstract public function processFile(string $file, CodeCloneMap $codeCloneMap): void;

    public function postProcess(): void
    {
    }
}
