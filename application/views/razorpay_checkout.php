<div class="container mx-auto p-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-semibold text-blue-600 mb-4">Complete Your Payment</h1>
        <p class="text-xl text-gray-500">Secure payment processing for your job posting</p>
    </div>

    <!-- Payment Details Section -->
    <div class="bg-white shadow-md rounded-lg p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Payment Details</h2>
            <p class="text-lg text-gray-600">You are about to make a payment of <span class="font-semibold text-blue-600">₹99.00</span> for posting a job.</p>
        </div>

        <div class="mb-8 text-center">
            <img src="<?php echo base_url('public/cover.png') ?>" alt="Logo" class="w-auto h-32 mx-auto mb-4">
        </div>

        <!-- Razorpay Checkout Section -->
        <div id="razorpay-checkout" class="text-center">
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script type="text/javascript">
                var options = {
                    "key": "rzp_test_cZGMGPXHmPtg1H", // Razorpay key ID
                    "amount": "9900", // Amount in paise (₹99)
                    "currency": "INR",
                    "name": "HireSphere",
                    "description": "Post your job",
                    "order_id": "<?= (string) $order_id; ?>",
                    "image": "<?php echo base_url('public/default.png') ?>",
                    "handler": function (response) {
                        $.ajax({
                            url: "<?= base_url('jobs/verify_payment'); ?>",
                            type: "POST",
                            data: {
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                job_id: "<?= $job_id; ?>"
                            },
                            success: function (data) {
                                window.location.href = "<?= base_url('jobs'); ?>";
                            }
                        });
                    },
                    "modal": {
                        "ondismiss": function() {
                            // Payment was canceled by the user
                            document.getElementById('payment-cancelled').style.display = 'block'; // Show cancelled div
                        }
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            </script>
        </div>

        <!-- Cancelled Payment Message -->
        <div id="payment-cancelled" class="bg-red-100 text-red-600 p-4 rounded-lg mt-6 text-center" style="display:none;">
            <p class="text-lg font-semibold">Payment Cancelled</p>
            <p class="text-gray-600">You have cancelled the payment. Redirect to <a class="text-blue-500" href="<?php echo base_url('jobs/post') ?>">previous page</a></p>
        </div>

        
    </div>
</div>
