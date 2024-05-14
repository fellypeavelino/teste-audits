<?php
declare(strict_types=1);

namespace PlatformXMLBuilder\Helpers;

use PlatformXMLBuilder\Rentify\RentifyXMLBuilder;
use PlatformXMLBuilder\Estatify\EstatifyXMLBuilder;

final class FormatosXml
{

    private $listaFormatos =  [
        'estatify' => EstatifyXMLBuilder::class,
        'rentify' => RentifyXMLBuilder::class,
    ];
    
    public function trazerBuilderPeloNome(string $caseName): mixed {
        if (!isset($this->listaFormatos[$caseName])) {
            return null;
        }
        $builderPath = $this->listaFormatos[$caseName];
        return new $builderPath();
    }
}
