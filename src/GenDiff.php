<?php

namespace Differ\GenDiff;

use function Differ\Parser\parse;
use function Differ\Ast\createAst;
use function Differ\Renderer\render;

function genDiff($beforeFile, $afterFile, $format): string
{
    $beforeData = parse($beforeFile);
    $afterData = parse($afterFile);
    $ast = createAst($beforeData, $afterData);
    $diff = render($ast, $format);
    //var_dump($diff);
    print_r($diff);
    return $diff;
}


