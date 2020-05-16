<?php

namespace Omnipay\PhpEsewa\Message;

use SimpleXMLElement;

/**
 * Class VerifyPaymentRequest.
 */
class VerifyPaymentRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $verifyUrl = 'epay/transrec';

    /**
     * @return string
     */
    public function getData()
    {
        return [
            'amt' => $this->getAmt(),
            'rid' => $this->getRid(),
            'pid' => $this->getPid(),
            'scd' => $this->getScd(),
        ];
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|VerifyPaymentResponse
     */
    public function sendData($data)
    {
        $endPoint = $this->getEndpoint().'?'.http_build_query($data);

        $httpResponse = $this->httpClient->request('GET', $endPoint);

        $data = new SimpleXMLElement($httpResponse->getBody()->getContents());

        return $this->response = new VerifyPaymentResponse($this, $data);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $endPoint = $this->getTestMode() ? $this->sandboxUrl : $this->liveUrl;

        return $endPoint.$this->verifyUrl;
    }
}
