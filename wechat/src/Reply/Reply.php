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
 * Reply.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace EasyWeChat\Reply;

use EasyWeChat\Core\AbstractAPI;

/**
 * Class Reply.
 */
class Reply extends AbstractAPI
{
    const API_GET_CURRENT_SETTING = 'https://api.weixin.qq.com/cgi-bin/get_current_autoreply_info';

    /**
     * Get current auto reply settings.
     *
     * @return \EasyWeChat\Support\Collection
     */
    public function current()
    {
        return $this->parseJSON('get', [self::API_GET_CURRENT_SETTING]);
    }
}
