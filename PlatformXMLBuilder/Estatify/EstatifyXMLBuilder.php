<?php

namespace PlatformXMLBuilder\Estatify;

use PlatformXMLBuilder\Contracts\XMLBuilderInterface;
use PlatformXMLBuilder\Helpers\Helpers;

final class EstatifyXMLBuilder implements XMLBuilderInterface
{

    public function formatarArray(array $array):array{
        $propertyXml = [];
        $propertyXml['created'] = $array['created'];
        $propertyXml['realState'] = [
            'phone' => $array["realStatePhone"],
            'email' => $array["realStateEmail"]
        ];
        $propertyXml['property'] = [
            'year' => $array["buildYear"],
            'ref' => $array["propertyRefence"],
            'type' => $array["propertyType"],
            'forSale' => ($array["propertyForSale"]) ? 'sim' : 'não',
            'forRent' => ($array["propertyForRent"]) ? 'sim' : 'não',
            'price' => [
                'sales' => $array["propertySalesPrice"],
                'rent' => $array["propertyRentPrice"],
            ],
        ];
        $propertyXml['address'] = [
            'street' => $array["addressStreet"],
            'number' => $array["addressNumber"],
            'complement' => $array["addressComplement"],
            'district' => $array["addressDistrict"],
            'city' => $array["addressCity"],
            'state' => $array["addressState"],
            'country' => $array["addressCountry"],
            'zipCode' => $array["addressZipCode"],
        ];
        $collectionXml = [
            'property' => $propertyXml
        ];

        return $collectionXml;
    }

    public function salvarXML(array $array, string $pathJson):string{
        $collectionXml = $this->formatarArray($array);
        return Helpers::converterESavarXml($collectionXml, "estatify", $pathJson, 'collection');
    }
}
