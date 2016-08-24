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
 * PaymentServiceProvider.php.
 *
 * Part of Overtrue\WeChat.
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

use TYWeChat\Payment\LuckyMoney\LuckyMoney;
use TYWeChat\Payment\Merchant;
use TYWeChat\Payment\MerchantPay\MerchantPay;
use TYWeChat\Payment\Payment;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class PaymentServiceProvider.
 */
class PaymentServiceProvider implements ServiceProviderInterface
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
        $pimple['merchant'] = function ($pimple) {
            $config = array_merge(
                ['app_id' => $pimple['config']['app_id']],
                $pimple['config']->get('payment', [])
            );

            return new Merchant($config);
        };

        $pimple['payment'] = function ($pimple) {
            return new Payment($pimple['merchant']);
        };

        $pimple['lucky_money'] = function ($pimple) {
            return new LuckyMoney($pimple['merchant']);
        };

        $pimple['merchant_pay'] = function ($pimple) {
            return new MerchantPay($pimple['merchant']);
        };
    }
}
