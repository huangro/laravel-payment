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
 * Semantic.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Semantic;

use TYWeChat\Core\AbstractAPI;

/**
 * Class Semantic.
 */
class Semantic extends AbstractAPI
{
    const API_SEARCH = 'https://api.weixin.qq.com/semantic/semproxy/search';

    /**
     * Get the semantic content of giving string.
     *
     * @param string       $keyword
     * @param array|string $categories
     * @param array        $other
     *
     * @return array
     */
    public function query($keyword, $categories, array $other = [])
    {
        $params = [
                   'query' => $keyword,
                   'category' => implode(',', (array) $categories),
                   'appid' => $this->getAccessToken()->getAppId(),
                  ];

        return $this->parseJSON('json', [self::API_SEARCH, array_merge($params, $other)]);
    }
}
