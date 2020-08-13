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

    protected $agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36';

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

    public function userAgent()
    {
        $agent = $this->agent;

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
        }

        return $agent;
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|VerifyPaymentResponse
     */
    public function sendData($data)
    {
        $endPoint = $this->getEndpoint();
        $headers = [
            'User-Agent' => $this->userAgent(),
            'Accept' => "application/xml",
            'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
        ];

        $httpResponse = $this->httpClient->request('POST', $endPoint, $headers, http_build_query($data));

        $data_ = new SimpleXMLElement($httpResponse->getBody()->getContents());

        return $this->response = new VerifyPaymentResponse($this, $data_);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $endPoint = $this->getTestMode() ? $this->sandboxUrl : $this->liveUrl;

        return $endPoint . $this->verifyUrl;
    }
}
