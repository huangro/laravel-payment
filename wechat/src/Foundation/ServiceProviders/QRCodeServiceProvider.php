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
 * QRCodeServiceProvider.php.
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

use TYWeChat\QRCode\QRCode;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class QRCodeServiceProvider.
 */
class QRCodeServiceProvider implements ServiceProviderInterface
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
        $pimple['qrcode'] = function ($pimple) {
            return new QRCode($pimple['access_token']);
        };
    }
}
