<?php

namespace Omnipay\PhpEsewa\Message;

/**
 * Class PurchaseRequest.
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $purchaseUrl = 'epay/main';

    /**
     * Prepare Data for API.
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('merchantCode', 'amt', 'tAmt', 'pid', 'fu', 'su');

        return [
            'amt'   => $this->getAmt(),
            'pdc'   => $this->getDC() ?: 0,
            'psc'   => $this->getSC() ?: 0,
            'txAmt' => $this->getTax() ?: 0,
            'tAmt'  => $this->getTAmt(),
            'pid'   => $this->getPid(),
            'scd'   => $this->getMerchantCode(),
            'su'    => $this->getSu(),
            'fu'    => $this->getFu(),
        ];
    }

    /**
     * @param $data
     *
     * @return \Omnipay\Esewa\Message\PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getEndpoint());
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $endPoint = $this->getTestMode() ? $this->sandboxUrl : $this->liveUrl;

        return $endPoint.$this->purchaseUrl;
    }
}
