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

final class Arguments
{
    /**
     * @param list<string> $directories
     * @param list<string> $suffixes
     * @param list<string> $exclude
     */
    public function __construct(
        /**
         * @psalm-var list<string>
         */
        private readonly array $directories,
        /**
         * @psalm-var list<string>
         */
        private readonly array $suffixes,
        /**
         * @psalm-var list<string>
         */
        private readonly array $exclude,
        private readonly ?string $pmdCpdXmlLogfile,
        private readonly bool $githubLogOutput,
        private readonly int $linesThreshold,
        private readonly int $tokensThreshold,
        private readonly bool $fuzzy,
        private readonly bool $verbose,
        private readonly bool $help,
        private readonly bool $version,
        private readonly ?string $algorithm,
        private readonly int $editDistance,
        private readonly int $headEquality
    ) {
    }

    /**
     * @psalm-return list<string>
     */
    public function directories(): array
    {
        return $this->directories;
    }

    /**
     * @psalm-return list<string>
     */
    public function suffixes(): array
    {
        return $this->suffixes;
    }

    /**
     * @psalm-return list<string>
     */
    public function exclude(): array
    {
        return $this->exclude;
    }

    public function pmdCpdXmlLogfile(): ?string
    {
        return $this->pmdCpdXmlLogfile;
    }

    public function githubLogOutput(): bool
    {
        return $this->githubLogOutput;
    }

    public function linesThreshold(): int
    {
        return $this->linesThreshold;
    }

    public function tokensThreshold(): int
    {
        return $this->tokensThreshold;
    }

    public function fuzzy(): bool
    {
        return $this->fuzzy;
    }

    public function verbose(): bool
    {
        return $this->verbose;
    }

    public function help(): bool
    {
        return $this->help;
    }

    public function version(): bool
    {
        return $this->version;
    }

    public function algorithm(): ?string
    {
        return $this->algorithm;
    }

    public function editDistance(): int
    {
        return $this->editDistance;
    }

    public function headEquality(): int
    {
        return $this->headEquality;
    }
}
