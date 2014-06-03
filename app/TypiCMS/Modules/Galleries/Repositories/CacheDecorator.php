<?php
namespace TypiCMS\Modules\Galleries\Repositories;

use App;

use TypiCMS\Repositories\CacheAbstractDecorator;
use TypiCMS\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements GalleryInterface
{

    // Class expects a repo and a cache interface
    public function __construct(GalleryInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    /**
     * Get all items name
     * 
     * @return array with names
     */
    public function getNames()
    {
        $cacheKey = md5(App::getLocale() . 'getNames');

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->getNames();

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Find existing galleries or forget it if they don't exist
     *
     * @param  array $galleries  Array of strings, each representing a tag
     * @return array        Array or Arrayable collection of Tag objects
     */
    public function findOrForget(array $galleries)
    {
        return $this->repo->findOrForget($galleries);
    }
}