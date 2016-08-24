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
 * Material.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Message;

/**
 * Class Material.
 */
class Material extends AbstractMessage
{
    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['media_id'];

    /**
     * Material constructor.
     *
     * @param string $mediaId
     * @param string $type
     */
    public function __construct($type, $mediaId)
    {
        $this->set('media_id', $mediaId);
        $this->type = $type;
    }
}
