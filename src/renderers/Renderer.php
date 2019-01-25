<?php

namespace Differ\Renderer;


function render()
{

}

function decode($pathFile)
{
    switch (getType($pathFile)) {

        case 'json':
            return json_decode(getData($pathFile), true);

        case 'yml':
            return new \Exception("unknown file format");
            
        default:
            return new \Exception("unknown file format");
    }

}

function getData($pathFile)
{
    if (file_exists($pathFile) && is_readable($pathFile)) {
        return file_get_contents($pathFile);
    } else {
        throw new \Exception("{$pathFile} not exist or is nor readable");
    }
}

function getType($pathFile)
{
    return pathinfo($pathFile, PATHINFO_EXTENSION);
}