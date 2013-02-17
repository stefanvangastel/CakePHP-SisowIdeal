<?php
/**
 * Dummy controller for testing and examples.
 *
 * PHP 5
 *
 * Stefan van Gastel
 * Copyright 2013
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2013, Stefan van Gastel (http://www.stefanvangastel.nl)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

class DummiesController extends AppController {

	//Use this plugins component
	public $components = array('SisowIdeal.Sisow');

	/**
	 * Function that acts as initializer. Is target of form containing bank selection
	 *
	 * I use some variables that can also be passed to the function by form or some other way.
	 */
	function payment(){		
		
		//Check bank:
		if( empty($this->request->data['Payment']['bank']) ){
			$this->Session->setFlash(__('Please select a bank'));
			$this->redirect($this->referer());
		}
		
		//Set some urls:
		App::import('Helper', 'Html');
		App::uses('View', 'View');
		$this->View = new View($this->Controller);
		$html = & new HtmlHelper($this->View);
		$baseurl = 'http://'.$_SERVER['HTTP_HOST'];

		$okurl = $baseurl.$html->url('/dummies/ok/');
		$failurl = $baseurl.$html->url('/dummies/fail/');

		//Random number for identifying. Could also be an invoicenumber
		$invoicenumber = rand(100,999);

		//Set the purchase id. This will be returned in the GET params after it completed or failed.
		$this->Sisow->purchaseId = $invoicenumber;

		//The description. The user will see this in his bank transactions overview.
		$this->Sisow->description = "Invoice $invoicenumber";

		//The amount
		$this->Sisow->amount = 25; //You can fill this any way you like / need.

		//The selected bank. Use 99 in testing mode.
		$this->Sisow->issuerId = 99;//$this->request->data['Payment']['bank']; 

		//Url that is called when the user completes the payment
		$this->Sisow->returnUrl = $okurl; 

		//Url that is called when the user cancels the payment.
		$this->Sisow->cancelUrl = $failurl; 

		//Callback url is used when the transaction timed-out. Sisow will then call this url.
		$this->Sisow->callbackUrl = $failurl; 

		//Initialize transaction request and catch + display errors
		if ( ($ex = $this->Sisow->TransactionRequest($eigenschappen) ) < 0) {
			$this->Session->setFlash('Error initializing payment, errorcode '.$ex.' please contact the websites administrator. ('.$this->Sisow->errorMessage.')');
			$this->redirect($this->referer());
		}

		die('Hoi');

		//No error given? Redirect to the Url provided by Sisow:
		$this->redirect($this->Sisow->issuerUrl);
		exit; //Just to make sure :)
	}
}