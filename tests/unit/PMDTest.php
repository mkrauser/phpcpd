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

use PHPUnit\Framework\TestCase;
use SebastianBergmann\PHPCPD\CodeClone;
use SebastianBergmann\PHPCPD\CodeCloneFile;
use SebastianBergmann\PHPCPD\CodeCloneMap;

/**
 * @covers \SebastianBergmann\PHPCPD\Log\AbstractXmlLogger
 * @covers \SebastianBergmann\PHPCPD\Log\PMD
 *
 * @uses \SebastianBergmann\PHPCPD\CodeClone
 * @uses \SebastianBergmann\PHPCPD\CodeCloneFile
 * @uses \SebastianBergmann\PHPCPD\CodeCloneMap
 * @uses \SebastianBergmann\PHPCPD\CodeCloneMapIterator
 */
final class PMDTest extends TestCase
{
    private string $testFile1;

    private string $testFile2;

    private string|false $pmdLogFile;

    private string|false $expectedPmdLogFile;

    private PMD $pmdLogger;

    public function testSubstitutesDisallowedCharacters(): void
    {
        $file1 = new CodeCloneFile($this->testFile1, 8);
        $file2 = new CodeCloneFile($this->testFile2, 8);
        $clone = new CodeClone($file1, $file2, 4, 4);
        $cloneMap = new CodeCloneMap();

        $cloneMap->add($clone);

        $this->pmdLogger->processClones($cloneMap);

        $this->assertXmlFileEqualsXmlFile(
            $this->expectedPmdLogFile,
            $this->pmdLogFile
        );
    }
}
