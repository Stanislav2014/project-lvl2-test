<?php

namespace DIffer\Tests;

use PHPUnit\FrameWork\TestCase;
use function Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{
    function testJsonPretty()
    {
        $expected = file_get_contents('./fixtures/expected');
        $pathToFile1 = '/fixtures/before.json';
        $pathToFile2 = '/fixtures/after.json';
    }
}