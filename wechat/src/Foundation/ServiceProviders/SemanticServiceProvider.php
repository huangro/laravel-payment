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
 * SemanticServiceProvider.php.
 *
 * Part of TYWeChat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016
 *
 * @link      https://github.com/huangro/laravel-payment
 */
namespace TYWeChat\Foundation\ServiceProviders;

use TYWeChat\Semantic\Semantic;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class SemanticServiceProvider.
 */
class SemanticServiceProvider implements ServiceProviderInterface
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
        $pimple['semantic'] = function ($pimple) {
            return new Semantic($pimple['access_token']);
        };
    }
}
