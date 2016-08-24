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
 * Article.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Message;

/**
 * Class Article.
 */
class Article extends AbstractMessage
{
    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
                                'thumb_media_id',
                                'author',
                                'title',
                                'content',
                                'digest',
                                'source_url',
                                'show_cover',
                            ];

    /**
     * Aliases of attribute.
     *
     * @var array
     */
    protected $aliases = [
        'source_url' => 'content_source_url',
        'show_cover' => 'show_cover_pic',
    ];
}
