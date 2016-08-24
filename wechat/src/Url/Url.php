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
 * Url.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Url;

use TYWeChat\Core\AbstractAPI;

/**
 * Class Url.
 */
class Url extends AbstractAPI
{
    const API_SHORTEN_URL = 'https://api.weixin.qq.com/cgi-bin/shorturl';

    /**
     * Shorten the url.
     *
     * @param string $url
     *
     * @return string
     */
    public function shorten($url)
    {
        $params = [
                   'action' => 'long2short',
                   'long_url' => $url,
                  ];

        return $this->parseJSON('json', [self::API_SHORTEN_URL, $params]);
    }
}
