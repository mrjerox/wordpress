// Fetch
const post = async (data) => {
    try {
        const response = await fetch(obj.AJAX_URL, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json, text/plain, */*',
                'Content-Type': 'application/x-www-form-urlencoded charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: (new URLSearchParams(data)).toString(),
        })

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

// Paypal 
const payPalCreateOrder = async (orderId, orderTotal) => {
    try {
        const response = await fetch(obj.PAYPAL_ORDER, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': obj.PAYPAL_TOKEN,
            },
            body: JSON.stringify({ 
                "intent": "CAPTURE", 
                "purchase_units": [
                    { 
                        //"reference_id": "d9f80740-38f0-11e8-b467-0ed5f89f718b", 
                        "amount": { 
                            "currency_code": "USD", 
                            "value": orderTotal, 
                        } 
                    } 
                ], 
                "payment_source": { 
                    "paypal": { 
                        "experience_context": { 
                            "payment_method_preference": "IMMEDIATE_PAYMENT_REQUIRED",
                            "brand_name": "nguoinghienchoidan", 
                            "locale": "en-US", 
                            "landing_page": "LOGIN", 
                            //  "shipping_preference": "SET_PROVIDED_ADDRESS", 
                            "user_action": "PAY_NOW", 
                            "return_url": `${obj.HOME_URL}/check-paypal-status?order-id=${orderId}`, 
                            "cancel_url": window.location.href, 
                            } 
                        } 
                    } 
                }
            )
        })

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

const payPalCheckOrder = async (id) => {
    try {
        const response = await fetch(obj.PAYPAL_ORDER + '/' + id, {
            headers: {
                'Authorization': obj.PAYPAL_TOKEN,
                'Content-Type': 'application/json',
            }
        })

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

const payPalCaptureOrder = async (id) => {
    try {
        const response = await fetch(obj.PAYPAL_ORDER + '/' + id + '/capture', {
            method: 'POST',
            headers: {
                'Authorization': obj.PAYPAL_TOKEN,
                'Content-Type': 'application/json',
            }
        })

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Lazyloading 
    const lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    })

    // Menu
    const btnMenu = document.querySelector('#btn-menu')
    const boxMobileMenu = document.querySelector('#box-mobile-menu')
    const boxMobileMenuItems = document.querySelectorAll('#box-mobile-menu ul li')
    const mobileMenuOverlay = document.querySelector('#box-mobile-menu .overlay')
    const mobileMenu = document.querySelector('#mobile-menu')
    const page = document.querySelector('#page')

    btnMenu.addEventListener('click', (e) => {
        e.preventDefault()
        boxMobileMenu.classList.toggle('active')
        mobileMenu.classList.toggle('active')
        page.classList.toggle('disable')
    })

    mobileMenuOverlay.addEventListener('click', (e) => {
        e.preventDefault()
        boxMobileMenu.classList.toggle('active')
        mobileMenu.classList.toggle('active')
        page.classList.toggle('disable')
    })

    boxMobileMenuItems.forEach((item) => {
        item.addEventListener('click', (e) => {
            boxMobileMenu.classList.toggle('active')
            mobileMenu.classList.toggle('active')
            page.classList.toggle('disable')
        })
    })


    // Search
    const btnSearch = document.querySelector('#btn-search')
    const boxSearch = document.querySelector('#search')
    const searchOverlay = document.querySelector('#search .overlay')

    btnSearch.addEventListener('click', (e) => {
        e.preventDefault()
        boxSearch.classList.toggle('active')
    })
    searchOverlay.addEventListener('click', (e) => {
        e.preventDefault()
        boxSearch.classList.toggle('active')
    })

    // Handle add to wishlist
    const btnWish = document.querySelectorAll('.btn-wish')
    btnWish.forEach(element => {
        element.addEventListener('click', async (e) => {
            e.preventDefault()
            let target = e.currentTarget
            let data = {
                action: 'add_to_wishlist',
                nonce: target.getAttribute('data-nonce'),
                context: 'frontend',
                add_to_wishlist: target.getAttribute('data-product-id'),
                product_type: target.getAttribute('data-product-type'),
            }

            target.classList.toggle('pending')
            const response = await post(data)

            if (response.result !== 'exists') {
                target.classList.toggle('pending')

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: obj.ADD_TO_WISHLIST
                })
                return
            }

            // Product exists in wishlist 
            target.classList.toggle('pending')
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: obj.ADD_TO_WISHLIST_EXIST
            })
            return
        })
    })

    // Handle open cart
    const btnCart = document.querySelectorAll('.btn-cart')
    const cartOverlay = document.querySelector('#left-cart .overlay')
    const cart = document.querySelector('#left-cart')
    btnCart.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault()
            const target = e.currentTarget
            cart.classList.toggle('active')
        })
    })
    cartOverlay.addEventListener('click', (e) => {
        e.preventDefault()
        const target = e.currentTarget
        cart.classList.toggle('active')
    })

    // Handle add to cart
    const btnAddToCart = document.querySelectorAll('.btn-add')
    btnAddToCart.forEach(element => {
        element.addEventListener('click', async (e) => {
            e.preventDefault()
            let target = e.currentTarget
            let data = {
                action: 'woocommerce_ajax_add_to_cart',
                nonce: target.getAttribute('data-nonce'),
                product_id: target.getAttribute('data-product-id'),
            }

            target.classList.toggle('pending')
            const response = await post(data)

            if (response.success) {
                target.classList.toggle('pending')
                let cartList = document.querySelector('.cart-item-list')
                cartList.innerHTML = response.data
                cart.classList.toggle('active')
                return
            }

            // Failed
            target.classList.toggle('pending')
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: obj.ADD_TO_CART_FAILED
            })
            return
        })
    })

    // Handle remove item in cart
    const leftCart = document.querySelector('.left-cart')
    // leftCart.classList.toggle('--pending')

    document.addEventListener('click', (e) => {
        let target = e.target
        let btnRemoveItems = document.querySelectorAll('.btn-remove-item')
        btnRemoveItems.forEach( async (item) => {
            if (item.contains(target)) {
                e.preventDefault()
                leftCart.classList.toggle('--pending')
    
                let itemTarget = target
                let nonce = itemTarget.getAttribute('data-nonce')
                let productId = itemTarget.getAttribute('data-id')
                let data = {
                    action: 'woocommerce_ajax_remove_item_in_cart',
                    nonce: nonce,
                    product_id: productId,
                }
    
                const response = await post(data)
    
                if (response.success) {
                    let cartList = document.querySelector('.cart-item-list')
                    cartList.innerHTML = response.data
                    leftCart.classList.toggle('--pending')
                    return
                }
    
                // Failed
                leftCart.classList.toggle('--pending')
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
            }
        })
    })

    // Handle quick buy
    const btnBuy = document.querySelectorAll('.btn-buy')
    btnBuy.forEach(element => {
        element.addEventListener('click', async (e) => {
            e.preventDefault()
            let target = e.currentTarget
            let data = {
                action: 'woocommerce_ajax_add_to_cart',
                nonce: target.getAttribute('data-nonce'),
                product_id: target.getAttribute('data-product-id'),
            }

            target.classList.toggle('pending')
            const response = await post(data)

            if (response.success) {
                target.classList.toggle('pending')
                window.location.href = obj.CART_URL
                return
            }

            // Failed
            return
        })
    })
})