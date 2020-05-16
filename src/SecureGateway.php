<?php

namespace Omnipay\PhpEsewa;

use Omnipay\Common\AbstractGateway;

/**
 * Class SecureGateway
 * @package Omnipay\PhpEsewa
 */
class SecureGateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'phpesewa';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'merchantCode' => '',
            'testMode' => false,
        ];
    }

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
     * @return SecureGateway
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
     * @param $value
     * @return SecureGateway
     */
    public function setRid($value) {
        return $this->setParameter('rid');
    }

    /**
     * @return mixed
     */
    public function getRid() {
        return $this->getParameter('rid');
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
     * @return string
     */
    public function getFu()
    {
        return $this->getParameter('fu');
    }

    /**
     * @param $value
     * @return SecureGateway
     */
    public function setFu($value)
    {
        return $this->setParameter('fu', $value);
    }

    /**
     * @return mixed
     */
    public function getSu()
    {
        return $this->getParameter('su');
    }

    /**
     * @param $value
     * @return SecureGateway
     */
    public function setSu($value)
    {
        return $this->setParameter('su', $value);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PhpEsewa\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function verifyPayment(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PhpEsewa\Message\VerifyPaymentRequest', $parameters);
    }
}
