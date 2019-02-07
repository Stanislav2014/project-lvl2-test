<?php

namespace DIffer\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testJsonPretty()
    {
        $expected = file_get_contents('./tests/fixtures/expected');
        //var_dump($expected);
        $pathToFile1 = './tests/fixtures/before.json';
        $pathToFile2 = './tests/fixtures/after.json';
        $actual = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals($expected, $actual);
    }

    public function testYmlPretty()
    {
        $expected = file_get_contents('./tests/fixtures/expected');
        //var_dump($expected);
        $pathToFile1 = './tests/fixtures/before.yml';
        $pathToFile2 = './tests/fixtures/after.yml';
        $actual = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals($expected, $actual);
    }
    public function testJsonRecursive()
    {
        $expected = file_get_contents('./tests/fixtures/expectedRecursive');
        //var_dump($expected);
        $pathToFile1 = './tests/fixtures/beforeRecursive.json';
        $pathToFile2 = './tests/fixtures/afterRecursive.json';
        $actual = genDiff($pathToFile1, $pathToFile2);
        print_r($actual);
        $this->assertEquals($expected, $actual);
    }
}
