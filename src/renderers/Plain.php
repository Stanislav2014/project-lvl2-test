<?php

namespace Differ\Renderer\Plain;
use function Differ\Renderer\boolToStr;
use function Differ\Renderer\stringifyPlain;
use function Funct\Collection\flattenAll;

function plain($ast)
{
    //var_dump($ast);
    $plained = array_map(function ($item) {
        return getPlain($item);
    }, $ast);

    return implode("\n", array_filter(flattenAll($plained), function ($item) {
        return $item ;
    }));
}

function getPlain($item, $path = [])
{
    //echo " ITEM " . var_dump($item);
    [
        'type' => $type,
        'key' => $key,
        'beforeValue' => $beforeValue,
        'afterValue' => $afterValue,
        'children' => $children

    ] = $item;

    $afterValue = is_array($afterValue) ? 'complex value' : $afterValue; //: is_bool($afterValue) ? boolToStr($afterValue) : $afterValue ;
    $beforeValue = is_array($beforeValue) ? 'complex value' : $beforeValue;

    $path[] = $key ;

    $pathForString = stringifyPlain($path);

    switch ($type) {

        case 'nested':
             
            return array_map( function ($item) use ($path) {
                return getPlain($item, $path);
            }, $children);

        //case 'unchanged':
        //    return $key . ": " . $beforeValue ;
    
        case 'changed':
            return "Property '{$pathForString}' was changed. From  '{$beforeValue}' to '{$afterValue}'" ;
    
        case 'added':
            return "Property '{$pathForString}' was added with value: '{$afterValue}'" ;

        case 'deleted':
            return "Property '{$pathForString}' was removed";
    
        //default:
        //break;
    }


}