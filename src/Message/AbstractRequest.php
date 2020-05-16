<?php

namespace Omnipay\PhpEsewa\Message;

use Omnipay\PhpEsewa\SecureGateway;

/**
 * Class AbstractRequest.
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $liveUrl = 'https://esewa.com.np/';

    /**
     * @var string
     */
    protected $sandboxUrl = 'https://uat.esewa.com.np/';

    /**
     * @return string
     */
    public function getScd()
    {
        return $this->getParameter('scd');
    }

    /**
     * @param $value
     */
    public function setScd($value)
    {
        return $this->setParameter('scd', $value);
    }

    /**
     * @param $value
     */
    public function setTax($value)
    {
        return $this->setParameter('txAmt', $value);
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->getParameter('txAmt');
    }

    /**
     * @param $value
     */
    public function setSC($value)
    {
        return $this->setParameter('psc', $value);
    }

    /**
     * @return string
     */
    public function getSC()
    {
        return $this->getParameter('psc');
    }

    /**
     * @param $value
     */
    public function setDC($value)
    {
        return $this->setParameter('pdc', $value);
    }

    /**
     * @return string
     */
    public function getDC()
    {
        return $this->getParameter('pdc');
    }

    /**
     * @param $value
     */
    public function setTAmt($value)
    {
        return $this->setParameter('tAmt', $value);
    }

    /**
     * @return string
     */
    public function getTAmt()
    {
        return $this->getParameter('tAmt');
    }

    /**
     * @param $value
     */
    public function setPid($value)
    {
        return $this->setParameter('pid', $value);
    }

    /**
     * @return string
     */
    public function getPid()
    {
        return $this->getParameter('pid');
    }

    /**
     * @param $value
     * @return AbstractRequest
     */
    public function setAmt($value)
    {
        return $this->setParameter('amt', $value);
    }

    /**
     * @return mixed
     */
    public function getAmt()
    {
        return $this->getParameter('amt');
    }
    /**
     * @return string
     */
    public function getFu()
    {
        return $this->getParameter('fu');
    }

    /**
     * @return mixed
     */
    public function getSu()
    {
        return $this->getParameter('su');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setSu($value)
    {
        return $this->setParameter('su', $value);
    }
    /**
     * @param string $value
     *
     * @return $this
     */
    public function setFu($value)
    {
        return $this->setParameter('fu', $value);
    }

    /**
     * @param $value
     * @return AbstractRequest
     */
    public function setRid($value) {
        return $this->setParameter('rid', $value);
    }

    /**
     * @return mixed
     */
    public function getRid()
    {
        return $this->getParameter('rid');
    }
}
