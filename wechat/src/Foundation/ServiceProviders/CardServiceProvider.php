<?php

/*
 * This file is part of the huangro/laravel-payment.
 *
 * (c) robin <robin@v5club.cn>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * JsServiceProvider.php.
 *
 * This file is part of the wechat.
 *
 * (c) robin <robin@v5club.cn>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace TYWeChat\Foundation\ServiceProviders;

use TYWeChat\Card\Card;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class JsServiceProvider.
 */
class CardServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['card'] = function ($pimple) {
            $card = new Card($pimple['access_token']);
            $card->setCache($pimple['cache']);

            return $card;
        };
    }
}
