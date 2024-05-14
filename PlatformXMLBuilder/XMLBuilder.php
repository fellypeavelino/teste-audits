<?php

namespace PlatformXMLBuilder;

use PlatformXMLBuilder\Helpers\FormatosXml;

class XMLBuilder
{
    /**
     * @param $jsonPath
     * @return void
     */
    public static function fromJson($jsonPath):void
    {
        try {
            echo 'jsonPath: ' . $jsonPath . PHP_EOL;
            $content = file_get_contents($jsonPath);
            $array = json_decode($content, true);
            foreach ($array['publishFor'] as $key => $value) {
                $builder = (new FormatosXml)->trazerBuilderPeloNome($value);
                $builder->salvarXML($array, $jsonPath);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}