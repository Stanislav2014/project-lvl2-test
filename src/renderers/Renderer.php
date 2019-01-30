<?php

namespace Differ\Renderer;

use function Differ\Renderer\Pretty\pretty;
use function Differ\Renderer\Plain\getPlain;


function render($ast, $format)
{
    switch ($format) {
        case 'pretty':
            return pretty($ast);
            
        case 'plain':
            return getPlain($ast);
        
        case 'json':
            return json_encode($ast, JSON_PRETTY_PRINT);
    }
}

function boolToStr($bool)
{
    return $bool ? 'true' : 'false' ;
}

function arrayToStr($value, $depth)
{
    if (!is_array($value)) {
        return $value;
    }
    return "{" . "\n" . implode("\n",
        array_map( function ($key, $item) use ($depth) {
            return getSpace($depth) . $key. ": " . $item;
        }, array_Keys($value), $value )) . "\n" . getSpace($depth - 1) . "}";
}

function getSpace($depth, $str = "")
{
    return str_pad($str, $depth * 4, " ", STR_PAD_LEFT);
}
