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

namespace SebastianBergmann\PHPCPD\Log;

use SebastianBergmann\PHPCPD\CodeCloneMap;

final class Text
{
    public function printResult(CodeCloneMap $codeCloneMap, bool $verbose): void
    {
        if (\count($codeCloneMap) > 0) {
            printf(
                'Found %d code clones with %d duplicated lines in %d files:'.\PHP_EOL.\PHP_EOL,
                \count($codeCloneMap),
                $codeCloneMap->numberOfDuplicatedLines(),
                $codeCloneMap->numberOfFilesWithClones()
            );
        }

        foreach ($codeCloneMap as $clone) {
            $firstOccurrence = true;

            foreach ($clone->files() as $file) {
                printf(
                    '  %s%s:%d-%d%s'.\PHP_EOL,
                    $firstOccurrence ? '- ' : '  ',
                    $file->name(),
                    $file->startLine(),
                    $file->startLine() + $clone->numberOfLines(),
                    $firstOccurrence ? ' ('.$clone->numberOfLines().' lines)' : ''
                );

                $firstOccurrence = false;
            }

            if ($verbose) {
                echo \PHP_EOL.$clone->lines('    ');
            }

            echo \PHP_EOL;
        }

        if ($codeCloneMap->isEmpty()) {
            echo 'No code clones found.'.\PHP_EOL.\PHP_EOL;

            return;
        }

        printf(
            '%s duplicated lines out of %d total lines of code.'.\PHP_EOL.
            'Average code clone size is %d lines, the largest code clone has %d lines'.\PHP_EOL.\PHP_EOL,
            $codeCloneMap->percentage(),
            $codeCloneMap->numberOfLines(),
            $codeCloneMap->averageSize(),
            $codeCloneMap->largestSize()
        );
    }
}
