<?php

namespace PlatformXMLBuilder\Contracts;

interface XMLBuilderInterface {

    public function formatarArray(array $array):array;
    public function salvarXML(array $array, string $pathJson):string;

}