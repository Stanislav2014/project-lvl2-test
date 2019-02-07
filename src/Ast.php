<?php

namespace Differ\Ast;

use function Funct\Collection\union;

function createNode($type, $key, $beforeValue, $afterValue, $children)
{
    return [
        'type' => $type,
        'key' => $key,
        'beforeValue' => $beforeValue,
        'afterValue' => $afterValue,
        'children' => $children
    ];
}

function createAst($beforeData, $afterData)
{
    //var_dump($beforeData);
    //var_dump($afterData);
    $keys = union(array_keys($beforeData), array_keys($afterData));
    var_dump($keys);
    $diffAst = array_map(function ($key) use ($beforeData, $afterData) {
        //var_dump($key);

        $beforeValue = $beforeData[$key] ?? "";
        $afterValue = $afterData[$key] ?? "";

        if (array_key_exists($key, $beforeData) && array_key_exists($key, $afterData)) {
            if (is_array($beforeValue) && is_array($afterValue)) {
                return createNode('nested', $key, null, null, createAst($beforeValue, $afterValue));
            } elseif ($beforeValue === $afterValue) {
                return createNode('unchanged', $key, $beforeValue, $afterValue, null);
            } elseif (($beforeValue !== $afterValue)) {
                return createNode('changed', $key, $beforeValue, $afterValue, null);
            }
        } elseif (array_key_exists($key, $beforeData) && !array_key_exists($key, $afterData)) {
            return createNode('deleted', $key, $beforeValue, null, null);
        } elseif (!array_key_exists($key, $beforeData) && array_key_exists($key, $afterData)) {
            return createNode('added', $key, null, $afterValue, null);
        }
    }, $keys);

    return $diffAst;
}
