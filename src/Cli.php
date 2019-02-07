<?php

namespace Differ\Cli;

use function Differ\GenDiff\genDiff;

const DOC = <<<DOC
Generate diff

Usage:
  gendiff (-h|--help)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help                     Show this screen
  --format <fmt>                Report format [default: pretty]
DOC;

function run()
{
    $args = \Docopt::handle(DOC);

    //var_dump($args);

    $beforeFile = $args['<firstFile>'];
    $afterFile = $args['<secondFile>'];
    $format = $args['--format'];
    //var_dump($beforeFile);
    //var_dump($afterFile);
    //var_dump($format);

    genDiff($beforeFile, $afterFile, $format);
}

