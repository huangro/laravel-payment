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
 * ServerServiceProvider.php.
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

use TYWeChat\Encryption\Encryptor;
use TYWeChat\Server\Guard;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServerServiceProvider.
 */
class ServerServiceProvider implements ServiceProviderInterface
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
        $pimple['encryptor'] = function ($pimple) {
            return new Encryptor(
                $pimple['config']['app_id'],
                $pimple['config']['token'],
                $pimple['config']['aes_key']
            );
        };

        $pimple['server'] = function ($pimple) {
            $server = new Guard($pimple['config']['token']);

            $server->debug($pimple['config']['debug']);

            $server->setEncryptor($pimple['encryptor']);

            return $server;
        };
    }
}
