<?php
class Custom_Paypal_Payment_Gateway extends WC_Payment_Gateway
{
    // Constructor for initializing the payment gateway
    public function __construct()
    {
        $this->id = 'custom_paypal_payment_gateway';
        $this->method_title = 'Paypal Payment Gateway';
        $this->method_description = 'a custom paypal payment gateway by tnhs.xyz';
        $this->has_fields = true;
        $this->init_form_fields();
        $this->init_settings();
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        // Add more settings here
        // ...
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    // Initialize settings fields
    public function init_form_fields()
    {
        $this->form_fields = array(
            'title' => array(
                'title' => __('Title', 'woocommerce'),
                'type' => 'text',
                'description' => __('This controls the title displayed during checkout.', 'woocommerce'),
                'default' => __('Custom Paypal Payment Gateway', 'woocommerce'),
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => __('Description', 'woocommerce'),
                'type' => 'textarea',
                'description' => __('This controls the description displayed during checkout.', 'woocommerce'),
                'default' => __('Pay using Paypal Payment Gateway', 'woocommerce'),
                'desc_tip' => true,
            ),
            // Add more fields here
            // ...
        );
    }

    // Process payment
    public function process_payment($order_id)
    {
        // Handle payment processing logic here
        $order = wc_get_order($order_id);

        // Set order status
        $order->update_status('on-hold', __('Checkout with custom payment. ', TEXTDOMAIN));

        // or call the Payment complete
        // $order->payment_complete();

        // Remove cart
        WC()->cart->empty_cart();

        // Return thankyou redirect
        return array(
            'result'    => 'success',
            'redirect'  => $this->get_return_url( $order )
        );
    }

    // Display payment fields during checkout
    public function payment_fields()
    {
        // Display payment fields such as credit card info or other required info
        // ...
    }
    // Validate payment fields
    public function validate_fields()
    {
        // Validate payment fields submitted by the customer
        // ...
    }
}
