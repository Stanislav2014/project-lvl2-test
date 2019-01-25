<?php

namespace Differ\GenDiff;

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
    $args = \Docopt::Handle(DOC);

    $beforeFile = $args['firstFile'];
    $afterFile = $args['secondFile'];
    $format = $args['fmt'];

    genDiff($beforeFile, $afterFile);
    
}

function genDiff($beforeFile, $afterFile, $format = 'pretty')
{
    $content1 = 

}


