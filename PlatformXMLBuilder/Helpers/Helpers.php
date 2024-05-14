<?php

namespace PlatformXMLBuilder\Helpers;
use Spatie\ArrayToXml\ArrayToXml;

final class Helpers
{
    public static function converterESavarXml(
        array $array, string $portal, 
        string $path, string $rootElementName
    ):string{
        $list = explode("/", $path);
        $nomeArquivo = end($list);
        $nomeArquivo = strtolower($nomeArquivo);
        $nomeArquivo = str_replace('.json','.xml', $nomeArquivo);
        $arrayToXml = new ArrayToXml(
            $array,
            [
                'rootElementName' => $rootElementName,
                '_attributes' => [
                    'version' => '1.0',
                    'encoding' => 'UTF-8',
                ],
            ],true,  // Pretty print
            'UTF-8',
            '1.0'
        );
        $result = $arrayToXml->prettify()->toXml();
        $directory = __DIR__."/../../cache/{$portal}/";
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0777, true)) {
                throw new \Exception("Falha ao criar diretório $directory");
            }
        }
        file_put_contents($directory.$nomeArquivo, $result);
        return $directory.$nomeArquivo;
    }
}
