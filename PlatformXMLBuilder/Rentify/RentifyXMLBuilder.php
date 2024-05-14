<?php

namespace PlatformXMLBuilder\Rentify;

use PlatformXMLBuilder\Contracts\XMLBuilderInterface;
use PlatformXMLBuilder\Helpers\Helpers;

final class RentifyXMLBuilder implements XMLBuilderInterface
{
    public function formatarArray(array $array):array{
        $imovelXml = [];
        $imovelXml['_attributes'] = [
            'dataCriacao' => $array['created']
        ];
        $imovelXml['anoConstrucao'] = $array["buildYear"];
        $imovelXml['contatoTelefone'] = $array["realStatePhone"];
        $imovelXml['referencia'] = $array["propertyRefence"];
        $imovelXml['tipoImovel'] = $array["propertyType"];
        if ($array["propertyForSale"]) {
            $imovelXml['disponibilidade'] = 'Venda';
        }
        if ($array["propertyForRent"]) {
            $imovelXml['disponibilidade'] = 'Locação';
        }
        if ($array["propertyForSale"] && $array["propertyForRent"]) {
            $imovelXml['disponibilidade'] = 'Venda e Locação';
        }
        $imovelXml['valorVenda'] = $array["propertySalesPrice"];
        $imovelXml['valorLocacao'] = $array["propertyRentPrice"];
        $imovelXml['enderecoRua'] = $array["addressStreet"];
        $imovelXml['enderecoNumero'] = $array["addressNumber"];
        $imovelXml['enderecoComplemento'] = $array["addressComplement"];
        $imovelXml['enderecoBairro'] = $array["addressDistrict"];
        $imovelXml['enderecoCidade'] = $array["addressCity"];
        $imovelXml['enderecoEstado'] = $array["addressState"];
        $imovelXml['enderecoPais'] = $array["addressCountry"];
        $imovelXml['enderecoCEP'] = $array["addressZipCode"];
        return ['imovel' => $imovelXml];
    }

    public function salvarXML(array $array, string $pathJson):string{
        $imoveis = $this->formatarArray($array);
        return Helpers::converterESavarXml($imoveis, "rentify", $pathJson, 'imoveis');
    }
}
