<?php

namespace nickurt\Plesk;

/**
 * @method static \nickurt\Plesk\Api\Authentication authentication()
 * @method static \nickurt\Plesk\Api\Cli cli()
 * @method static \nickurt\Plesk\Api\Clients clients()
 * @method static \nickurt\Plesk\Api\Domains domains()
 * @method static \nickurt\Plesk\Api\Extensions extensions()
 * @method static \nickurt\Plesk\Api\Server server()
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'Plesk';
    }
}
