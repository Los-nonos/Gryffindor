<?php


namespace Application\Services\Hash;


interface HashServiceInterface
{
    public function Hash($data, $key, $key2): string;
    public function VerificateHash($data, $dataUnhashed): bool;
}
