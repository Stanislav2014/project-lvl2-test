<?php

namespace Differ\Renderer\Pretty;

use function Differ\Renderer\boolToStr;
use function Differ\Renderer\stringifyPretty;
use function Differ\Renderer\getSpace;

function pretty($ast)
{
    $rended = array_map(function ($item) {
        return getPretty($item, 1);
    }, $ast);
    return "{" . "\n" . implode("\n", $rended) . "\n" . "}";
}

function getPretty($item, $depth = 1)
{
    
        [
            'type' => $type,
            'key' => $key,
            'beforeValue' => $beforeValue,
            'afterValue' => $afterValue,
            'children' => $children

        ] = $item;
        //var_dump($beforeValue);
        //var_dump($afterValue);

        $beforeValue = is_bool($beforeValue) ? boolToStr($beforeValue) : stringifyPretty($beforeValue, $depth + 1);
        $afterValue = is_bool($afterValue) ? boolToStr($afterValue) : stringifyPretty($afterValue, $depth + 1);
            
        var_dump($key);
        var_dump($beforeValue);
        var_dump($afterValue);
        

        switch ($type) {
            case 'nested':
                return
                getSpace($depth) . "$key: {" . "\n" . implode(
                    "\n",
                    array_map(function ($item) use ($depth) {
                        return getPretty($item, $depth + 1);
                    },
                    $children)
                ) . "\n" .
                    getSpace($depth) . "}";

            case 'unchanged':
                return getSpace($depth, "  ") . $key . ": " . $beforeValue ;
        
            case 'changed':
                return getSpace($depth, "+ ") . $key . ": " . $afterValue . "\n" .
                       getSpace($depth, "- ") . $key . ": " . $beforeValue;
        
            case 'added':
                return getSpace($depth, "+ ") . $key . ": " . $afterValue;

            case 'deleted':
                return getSpace($depth, "- ") . $key . ": " . $beforeValue;
        }

    //var_dump($rended);
}
