<?php
include 'checkout.php';
$order_id = uniqid();
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function pay_now() {
        var name = jQuery('#name').val();
        var phone = jQuery('#phone').val();
        var altPhone = jQuery('#altPhone').val();
        var email = jQuery('#email').val();
        var address = jQuery('#address').val();
        var pincode = jQuery('#pincode').val();
        var city = jQuery('#city').val();
        var landmark = jQuery('#landmark').val();

        if (name === '' || phone === '' || email === '' || address === '' || pincode === '' || city === '') {
            alert('Please fill in all required fields.');
            return false;
        }

        jQuery.ajax({
            type: 'post',
            url: 'payment_process.php',
            data: {
                name: name,
                phone: phone,
                altPhone: altPhone,
                email: email,
                address: address,
                pincode: pincode,
                city: city,
                landmark: landmark,
                amount: <?php echo $amount; ?>,
                order_id: '<?php echo $order_id; ?>'
            },
            success: function(result) {
                var options = {
                    "key": "rzp_test_qHYXxTlCH5IzC0",
                    "amount": <?php echo $amount; ?> * 100,
                    "currency": "INR",
                    "name": "Rent It",
                    "description": "Test Transaction",
                    "image": "rentlogo.jpeg",
                    "handler": function(response) {
                        jQuery.ajax({
                            type: 'post',
                            url: 'payment_process.php',
                            data: {
                                payment_id: response.razorpay_payment_id,
                                name: name,
                                phone: phone,
                                altPhone: altPhone,
                                email: email,
                                address: address,
                                pincode: pincode,
                                city: city,
                                landmark: landmark,
                                amount: <?php echo $amount; ?>,
                                order_id: '<?php echo $order_id; ?>'
                            },
                            success: function(result) {
                                var useDiamondsParam = '<?php echo isset($_GET['useDiamonds']) ? "&useDiamonds=" . $_GET['useDiamonds'] : ""; ?>';
                                window.location.href = "thank_you.php?amount=<?php echo $amount; ?>" + useDiamondsParam + "&order_id=<?php echo $order_id; ?>";
                            }
                        });
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }
        });
    }
</script>
