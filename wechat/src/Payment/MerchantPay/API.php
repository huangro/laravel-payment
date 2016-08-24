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
 * API.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Payment\MerchantPay;

use TYWeChat\Core\AbstractAPI;
use TYWeChat\Payment\Merchant;
use TYWeChat\Support\Collection;
use TYWeChat\Support\XML;
use Psr\Http\Message\ResponseInterface;

/**
 * Class API.
 */
class API extends AbstractAPI
{
    /**
     * Merchant instance.
     *
     * @var Merchant
     */
    protected $merchant;

    // api
    const API_SEND = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
    const API_QUERY = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gettransferinfo';

    /**
     * API constructor.
     *
     * @param \TYWeChat\Payment\Merchant $merchant
     */
    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Query MerchantPay.
     *
     * @param string $mchBillNo
     *
     * @return \TYWeChat\Support\Collection
     *
     * @notice mch_id when query, but mchid when send
     */
    public function query($mchBillNo)
    {
        $params = [
            'appid' => $this->merchant->app_id,
            'mch_id' => $this->merchant->merchant_id,
            'partner_trade_no' => $mchBillNo,
        ];

        return $this->request(self::API_QUERY, $params);
    }

    /**
     * Send MerchantPay.
     *
     * @param array $params
     *
     * @return \TYWeChat\Support\Collection
     */
    public function send(array $params)
    {
        $params['mchid'] = $this->merchant->merchant_id;
        $params['mch_appid'] = $this->merchant->app_id;

        return $this->request(self::API_SEND, $params);
    }

    /**
     * Merchant setter.
     *
     * @param Merchant $merchant
     *
     * @return $this
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Merchant getter.
     *
     * @return Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * Make a API request.
     *
     * @param string $api
     * @param array  $params
     * @param string $method
     *
     * @return \TYWeChat\Support\Collection
     */
    protected function request($api, array $params, $method = 'post')
    {
        $params = array_filter($params);
        $params['nonce_str'] = uniqid();
        $params['sign'] = \TYWeChat\Payment\generate_sign($params, $this->merchant->key, 'md5');

        $options = [
            'body' => XML::build($params),
            'cert' => $this->merchant->get('cert_path'),
            'ssl_key' => $this->merchant->get('key_path'),
        ];

        return $this->parseResponse($this->getHttp()->request($api, $method, $options));
    }

    /**
     * Parse Response XML to array.
     *
     * @param ResponseInterface $response
     *
     * @return \TYWeChat\Support\Collection
     */
    protected function parseResponse($response)
    {
        if ($response instanceof ResponseInterface) {
            $response = $response->getBody();
        }

        return new Collection((array) XML::parse($response));
    }
}
