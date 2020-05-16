# Php Esewa
php-esewa is a package which is developed to implement [esewa](https://esewa.com.np) support for [Omnipay](https://github.com/thephpleague/omnipay). Omnipay is a payment processing library for PHP.

**Installation**

As this package is esewa support for Omnipay, installation of omnipay library is must.
 

    composer require league/omnipay

    composer require jwn25/php-esewa

## Laravel Usage
**Config**

Add following lines on config/services.php

    'esewa' => [  
	  'merchant_code' => env('ESEWA_MERCHANT_CODE', 'epay_payment'),  
	  'test_mode' => env('ESEWA_TEST_MODE', true)  
	]
**ENV**

Update your `.env` with credentials provided by esewa.

    ESEWA_MERCHANT_CODE=YOUR_MERCHANT_CODE
    ESEWA_TEST_MODE=false

**Routes**

    Route::post('/order/{order_id}/payment-process', 'PaymentController@processPayment');

	Route::get('/order/{order_id}/payment-failed', 'PaymentController@paymentFailed')->name('payment-failed');  
	  
	Route::get('/order/{order_id}/payment-completed', 'PaymentController@paymentCompleted')->name('payment-completed');
**Controller**

    <?php  
      
    namespace App\Http\Controllers;  
      
    use Illuminate\Http\Request;  
    use Omnipay\Omnipay;  
      
    class PaymentController extends Controller {
	    protected $payment_gateway;
	    
	    public function __construct() {
		    $this->payment_gateway = Omnipay::create('PhpEsewa_Secure');
		    $this->payment_gateway->setScd(config('services.esewa.merchant_code'));
		    $this->payment_gateway->setTestMode(config('services.esewa.test_mode'));
	    }

		public function processPayment($order_id) {
			try {  
			  $response = $this->payment_gateway->purchase([  
				  'amt' => 100,  
				  'txAmt' => 0,  
				  'psc' => 0,  
				  'pdc' => 0,  
				  'tAmt' => 100,  
				  'pid' => rand(10, 10000),  
				  'su' => route('payment-completed', $order_id),  
				  'fu' => route('payment-failed', $order_id),  
			  ])->send();  
			} catch (Exception $e) {  
			  //return back with some proper payment somehow failed message.
			}
			if ($response->isRedirect()) {  
			  $response->redirect();  
			} else {  
			  //return back with some proper payment somehow failed message.
			}
		}
		
		public function paymentCompleted($order_id, Request $request)  
		{  
		  $response = $this->payment_gateway->verifyPayment([  
			  'amt' => $request->get(amt),  
			  'rid' => $request->get('refId'),  
			  'pid' => $request->get('oid'),  
		  ])->send();  
		  
		  
		 if ($response->isSuccessful()) {
			 // Update your order payment status using $order_id
		  	 //redirect users to show some congratulations message (To make them feel good)
		  }  else {
			  //IF SOMEHOW SOMETHING WENT WRONG INTERNALLY. Redirect users to route with proper message.
		     // return redirect()->route('YOUR_ROUTE')->with('message', 'Your payment has been declined. Please retry.')
		  }
		}
		
		public function paymentFailed($order_id) {  
		  //Redirect user back with payment failed message  
		}
    }  
	 
		

## Simple PHP Usage
**Making Purchase**

    use Omnipay\Omnipay;
    use Exception;

    $payment_gateway = Omnipay::create('PhpEsewa_Secure');

    $payment_gateway->setScd('MERCHANT_CODE');
    $payment_gateway->setTestMode(true); //set it false if you want live mode.

    try {
        $resp = $payment_gateway->purchase([
            'amt' => 100,  
		    'txAmt' => 0,  
			'psc' => 0,  
			'pdc' => 0,  
			'tAmt' => 100,  
			'pid' => rand(10,10000),  
			'su' => 'https://yoursite.com/payment/success,  
			'fu' => 'https://yoursite.com/payment/failed',
        ])->send();

        if ($resp->isRedirect()) {
            $resp->redirect();
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }

**Payment Verification**

    $payment_gateway = Omnipay::create('PhpEsewa_Secure');

    $payment_gateway->setScd('MERCHANT_CODE');
    $payment_gateway->setTestMode(true); //set it false if you want live mode.
	
	$resp = $payment_gateway->verifyPayment([
		'amt' => $request->amt,  
		'rid' => $request->get('refId'),  
		'pid' => $request->get('oid'),
	])->send();
	if($resp->isSuccessful()) {
	 //DO WHATEVER YOU WANT AFTER PAYMENT SUCCESS
	}
	//DO SOMETHING IF FAILED

## ESEWA Documentation
Visit and go through [Esewa Offical Developer's Guide](https://developer.esewa.com.np/) to know about parameters and payment processes in detail.

## Confusion?
Feel free to contact me on jeewandhakal25@gmail.com if you are confused.