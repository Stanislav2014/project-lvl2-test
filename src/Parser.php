<?php

namespace Differ\Parser;

use Symfony\Component\Yaml\Yaml;


function parse($pathToFile)
{
    switch (getType($pathToFile)) {
        case 'json':
            return json_decode(getData($pathToFile), true);

        case 'yml':
            return Yaml::parse(getData($pathToFile));
            
        default:
            return new \Exception("unknown file format");
    }
}

function getData($pathToFile)
{
    if (file_exists($pathToFile) && is_readable($pathToFile)) {
        return file_get_contents($pathToFile);
    } else {
        throw new \Exception("{$pathToFile} not exist or is not readable");
    }
}

function getType($pathToFile)
{
    return pathinfo($pathToFile, PATHINFO_EXTENSION);
}