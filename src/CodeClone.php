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

namespace SebastianBergmann\PHPCPD;

final class CodeClone
{
    /**
     * @psalm-var array<string,CodeCloneFile>
     */
    private array $files = [];

    private readonly string $id;

    private string $lines = '';

    public function __construct(CodeCloneFile $fileA, CodeCloneFile $fileB, private readonly int $numberOfLines, private readonly int $numberOfTokens)
    {
        $this->add($fileA);
        $this->add($fileB);
        $this->id = md5($this->lines());
    }

    public function add(CodeCloneFile $file): void
    {
        $id = $file->id();

        if (!isset($this->files[$id])) {
            $this->files[$id] = $file;
        }
    }

    /**
     * @psalm-return array<string,CodeCloneFile>
     */
    public function files(): array
    {
        return $this->files;
    }

    public function lines(string $indent = ''): string
    {
        if ('' === $this->lines) {
            $file = current($this->files);

            $this->lines = implode(
                '',
                array_map(
                    static fn(string $line): string => $indent.$line,
                    \array_slice(
                        file($file->name()),
                        $file->startLine() - 1,
                        $this->numberOfLines
                    )
                )
            );
        }

        return $this->lines;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function numberOfLines(): int
    {
        return $this->numberOfLines;
    }

    public function numberOfTokens(): int
    {
        return $this->numberOfTokens;
    }
}
