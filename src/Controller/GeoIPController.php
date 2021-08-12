<?php

namespace App\Controller;

use App\Service\GeoIP\GeoIPService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GeoIPController extends AbstractController
{
    #[Route('/geoip/resolve/{ip}', name: 'geoip_resolve')]
    public function resolve(GeoIPService $geoIP, ?string $ip = null): Response {
        $myIp = $ip ?? file_get_contents('https://api.ipify.org');

        return $this->json($geoIP->resolveIp($myIp));
    }
}
