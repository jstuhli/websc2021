<?php


namespace App\Service\GeoIP;


class GeoIPService
{
    public function resolveIp(string $ip)
    {
        sleep(rand(1, 5));

        return json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
    }
}