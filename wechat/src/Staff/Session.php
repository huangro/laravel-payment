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
 * Session.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Staff;

use TYWeChat\Core\AbstractAPI;

/**
 * Class Session.
 */
class Session extends AbstractAPI
{
    const API_CREATE = 'https://api.weixin.qq.com/customservice/kfsession/create';
    const API_CLOSE = 'https://api.weixin.qq.com/customservice/kfsession/close';
    const API_GET = 'https://api.weixin.qq.com/customservice/kfsession/getsession';
    const API_LISTS = 'https://api.weixin.qq.com/customservice/kfsession/getsessionlist';
    const API_WAITERS = 'https://api.weixin.qq.com/customservice/kfsession/getwaitcase';

    /**
     * List all sessions of $account.
     *
     * @param string $account
     *
     * @return \TYWeChat\Support\Collection
     */
    public function lists($account)
    {
        return $this->parseJSON('get', [self::API_LISTS, ['kf_account' => $account]]);
    }

    /**
     * List all waiters of $account.
     *
     * @return \TYWeChat\Support\Collection
     */
    public function waiters()
    {
        return $this->parseJSON('get', [self::API_WAITERS]);
    }

    /**
     * Create a session.
     *
     * @param string $account
     * @param string $openId
     *
     * @return \TYWeChat\Support\Collection
     */
    public function create($account, $openId)
    {
        $params = [
                   'kf_account' => $account,
                   'openid' => $openId,
                  ];

        return $this->parseJSON('json', [self::API_CREATE, $params]);
    }

    /**
     * Close a session.
     *
     * @param string $account
     * @param string $openId
     *
     * @return \TYWeChat\Support\Collection
     */
    public function close($account, $openId)
    {
        $params = [
                   'kf_account' => $account,
                   'openid' => $openId,
                  ];

        return $this->parseJSON('json', [self::API_CLOSE, $params]);
    }

    /**
     * Get a session.
     *
     * @param string $openId
     *
     * @return \TYWeChat\Support\Collection
     */
    public function get($openId)
    {
        return $this->parseJSON('get', [self::API_GET, ['openid' => $openId]]);
    }
}
