<?php


namespace Application\Services\Token;


use Illuminate\Support\Str;

class GenerateRandomTokenService
{
    public function generate(int $length): string
    {
        return Str::random($length);
    }
}
