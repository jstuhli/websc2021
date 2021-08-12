<?php

namespace App\Controller;

use App\Service\GeoIP\GeoIPService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GeoIPController extends AbstractController
{
    #[Route('/geoip/resolve/{ip}', name: 'geoip_resolve')]
    #[Cache(maxage: 30, public: true)]
    public function resolve(GeoIPService $geoIP, ?string $ip = null): Response {
        $myIp = $ip ?? file_get_contents('https://api.ipify.org');

        return $this->json($geoIP->resolveIp($myIp));
    }
}
