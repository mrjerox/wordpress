<?php

/**
 * Template Name: Check Paypal
 */
get_header();

wp_nonce_field('paypal_nonce', 'paypal_nonce');
?>

<script>
    window.addEventListener('DOMContentLoaded', async () => {
        let timerInterval;
        Swal.fire({
            title: obj.PAYPAL_CHECK,
            html: "",
            timer: 999999,
            timerProgressBar: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        })

        const nonce = document.querySelector('#paypal_nonce').value
        const urlParams = new URLSearchParams(window.location.search);

        // Check order status
        const orderResponse = await payPalCheckOrder(urlParams.get('token'))

        if (orderResponse.status === 'COMPLETED') {
            Swal.fire({
                position: "center",
                icon: "success",
                title: obj.PAYPAL_CHECK_SUCCESS,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = obj.DOWNLOADS_URL
            });

            return
        }

        // Capture order
        const captureOrderResponse = await payPalCaptureOrder(urlParams.get('token'))

        if (captureOrderResponse && captureOrderResponse.status === 'COMPLETED') {
            let data = {
                action: 'ajax_check_paypal_status',
                nonce: nonce,
                order_id: urlParams.get('order-id'),
                token: urlParams.get('token')
            }
            let response = await post(data)

            if (response.success) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.data,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = obj.DOWNLOADS_URL
                });

                return
            }

            Swal.fire({
                position: "center",
                icon: "error",
                title: response.data,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = obj.ORDERS_URL
            });

            return
        }

        Swal.fire({
            position: "center",
            icon: "error",
            title: obj.PAYPAL_CHECK_FAILED,
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = obj.ORDERS_URL
        });

        return
    })
</script>
<?php get_footer();
