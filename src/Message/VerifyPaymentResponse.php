<?php

namespace Omnipay\PhpEsewa\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class VerifyPaymentResponse.
 */
class VerifyPaymentResponse extends AbstractResponse
{
    /**
     * @param RequestInterface $request
     * @param $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        $response_string = (string) $this->data->response_code;
        $isSuccess = strpos($response_string, 'Success');
        return ($isSuccess !== false) ? true : false;
    }
}
