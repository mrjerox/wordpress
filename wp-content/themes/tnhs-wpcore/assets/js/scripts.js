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

document.addEventListener('DOMContentLoaded', () => {
    // Lazyloading 
    const lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    });

    // Menu
    const btnMenu = document.querySelector('#btn-menu')
    const boxMobileMenu = document.querySelector('#box-mobile-menu')
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
    const btnCart = document.querySelector('.btn-cart');
    const cartOverlay = document.querySelector('#left-cart .overlay');
    const cart = document.querySelector('#left-cart')
    btnCart.addEventListener('click', (e) => {
        e.preventDefault()
        const target = e.currentTarget
        cart.classList.toggle('active')
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
                console.log(response.data);
                target.classList.toggle('pending')
                let cartList = document.querySelector('.cart-item-list'); 
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

    // Handle add to quick buy
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
            console.log(response)
            return
        })
    })
})