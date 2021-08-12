<?php


namespace App\Service\GeoIP;


use Psr\Cache\CacheItemPoolInterface;


class CachedGeoIPService extends GeoIPService
{
    /**
     * @var GeoIPService
     */
    private GeoIPService $geoIPService;
    /**
     * @var CacheItemPoolInterface
     */
    private CacheItemPoolInterface $pool;

    public function __construct(GeoIPService $geoIPService, CacheItemPoolInterface $pool, $ttl)
    {
        $this->geoIPService = $geoIPService;
        $this->pool         = $pool;
    }

    public function resolveIp(string $ip)
    {
        $key  = 'geoip_' . $ip;
        $item = $this->pool->getItem($key);

        if ($item->isHit()) {
            return $item->get();
        }

        $result = $this->geoIPService->resolveIp($ip);

        $item->set($result);
        $item->expiresAfter(60);

        $this->pool->save($item);

        return $result;
    }
}