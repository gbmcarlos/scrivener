<?php

/*
 * Transform the output of
 * InkscapeMap (https://sourceforge.net/projects/inkscapemap/)
 * to an SVG with geo-referenced coordinates as input for
 * MyGeodata's SVG to SHP convertor (https://mygeodata.cloud/converter/svg-to-shp)
 */

$inputFile = "/var/task/src/5-districts-coordinates.txt";
$outputFile = "/var/task/src/5-districts-coordinates.svg";

$startPointOrigin = [0, 0];
$startPointTarget = [74.96, -139.77];

$endPointOrigin = [106952, 55176];
$endPointTarget = [-59.16, 139.25];

$coordinatesPlain = file_get_contents($inputFile);

$lines = explode("\n", $coordinatesPlain);

$nodes = [];

foreach ($lines as $line) {

    if (empty($line) || substr($line, 0, 2) == '//') {
        continue;
    }

    $parts = explode(";", $line);

    $node = "<{$parts[0]} id=\"{$parts[1]}\" points=\"{$parts[2]}\" />";

    $nodes[] = $node;

}

$meta = "<MetaInfo xmlns=\"http://www.prognoz.ru\"><Geo><GeoItem X=\"{$startPointOrigin[0]}\" Y=\"${startPointOrigin[1]}\" Latitude=\"{$startPointTarget[0]}\" Longitude=\"${startPointTarget[1]}\"/><GeoItem X=\"$endPointOrigin[0]\" Y=\"{$endPointOrigin[1]}\" Latitude=\"{$endPointTarget[0]}\" Longitude=\"{$endPointTarget[1]}\"/></Geo></MetaInfo>";

$output = "<svg>" . "$meta" . implode("\n", $nodes) . "</svg>";

file_put_contents($outputFile, $output);