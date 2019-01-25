<?php

namespace Differ\Ast;

function createNode()
{
}

function createAst($content1, $content2)
{
    $keys = array_unique(array_merge($content1, $content2));

    $diffAst = array_map(function($item) use ($content1, $content2) {

    }, $keys);

}
