<?php

namespace Core\Rocket\Pages\Observer;

use Framework\EventManager\CoreObserver;

class RouterUriProcessBefore extends CoreObserver
{
    public function run($url)
    {
        // TODO: get urls from rewrites table

        return $url;
    }
}
