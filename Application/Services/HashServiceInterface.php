<?php


namespace Application\Services;


interface HashServiceInterface
{
    public function Hash($data, $key, $key2): string;
    public function VerificateHash($data, $dataUnhashed): boolean;
}
