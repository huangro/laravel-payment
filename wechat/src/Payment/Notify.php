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
 * Notify.php.
 *
 * @author    robin <robin@v5club.cn>
 * @copyright 2016 robin <robin@v5club.cn>
 *
 * @link      https://github.com/huangro
 */
namespace TYWeChat\Payment;

use TYWeChat\Core\Exceptions\FaultException;
use TYWeChat\Support\Collection;
use TYWeChat\Support\XML;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Notify.
 */
class Notify
{
    /**
     * Merchant instance.
     *
     * @var \TYWeChat\Payment\Merchant
     */
    protected $merchant;

    /**
     * Request instance.
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * Payment notify (extract from XML).
     *
     * @var Collection
     */
    protected $notify;

    /**
     * Constructor.
     *
     * @param Merchant $merchant
     * @param Request  $request
     */
    public function __construct(Merchant $merchant, Request $request = null)
    {
        $this->merchant = $merchant;
        $this->request = $request ?: Request::createFromGlobals();
    }

    /**
     * Validate the request params.
     *
     * @return bool
     */
    public function isValid()
    {
        $localSign = generate_sign($this->getNotify()->except('sign')->all(), $this->merchant->key, 'md5');

        return $localSign === $this->getNotify()->get('sign');
    }

    /**
     * Return the notify body from request.
     *
     * @return \TYWeChat\Support\Collection
     *
     * @throws \TYWeChat\Core\Exceptions\FaultException
     */
    public function getNotify()
    {
        if (!empty($this->notify)) {
            return $this->notify;
        }
        try {
            $xml = XML::parse(strval($this->request->getContent()));
        } catch (\Throwable $t) {
            throw new FaultException('Invalid request XML: '.$t->getMessage(), 400);
        } catch (\Exception $e) {
            throw new FaultException('Invalid request XML: '.$e->getMessage(), 400);
        }

        if (!is_array($xml) || empty($xml)) {
            throw new FaultException('Invalid request XML.', 400);
        }

        return $this->notify = new Collection($xml);
    }
}
