<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Razorpay\Api\Api;

class Razorpay {

    private $key_id = 'rzp_test_cZGMGPXHmPtg1H'; // rzp_live_0BrLtLByypvdZw
    private $key_secret = 'sEUi3bzTUKW6WOVCr3SV60n6'; // kBexaeLERa6Bb5ZNbZBCZMeI

    public function __construct() {
        require_once(APPPATH . 'libraries/razorpay/Razorpay.php'); // Include Razorpay SDK
    }

    public function createOrder($amount) {
        $api = new Api($this->key_id, $this->key_secret);

        // Create an order
        $order_data = [
            'receipt' => (string) ('order_' . time() . rand(1000, 9999)),
            'amount' => $amount * 100, // Amount in paise (INR)
            'currency' => 'INR',
            'payment_capture' => 1
        ];

        $order = $api->order->create($order_data);

        // Get the order ID
        $orderId = (string) $order->id;  // Ensure it's a string

        return $orderId;
    }

    public function verifyPayment($payment_id, $order_id, $signature) {
        $api = new Api($this->key_id, $this->key_secret);

        try {
            // Verify payment signature
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
