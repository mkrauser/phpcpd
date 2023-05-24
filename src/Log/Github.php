<?php declare(strict_types=1);
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

final class Github
{
    /** @noinspection UnusedFunctionResultInspection */
    public function processClones(CodeCloneMap $clones): void
    {
        foreach ($clones as $clone) {
            foreach ($clone->files() as $file) {
                $metas = [
                    'file=' . $file->name(),
                    'line=' . $file->startLine(),
                    'endline=' . ($file->startLine() + $clone->numberOfLines()),
                ];

                $message = 'Duplicated code detected';
                printf('::error %s::%s', implode(',', $metas), $message) . PHP_EOL;
            }

            print PHP_EOL;
        }
    }
}
