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
 * Raw.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Message;

/**
 * Class Raw.
 */
class Raw extends AbstractMessage
{
    /**
     * @var string
     */
    protected $type = 'raw';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['content'];

    /**
     * Constructor.
     *
     * @param array $content
     */
    public function __construct($content)
    {
        parent::__construct(['content' => strval($content)]);
    }
}
