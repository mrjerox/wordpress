document.addEventListener('DOMContentLoaded', () => {
    const btnLogin = document.querySelector('#btn-login')
    btnLogin.addEventListener('click', async (e) => {
        e.preventDefault()
        const user = document.querySelector('#email')
        const password = document.querySelector('#email')
        let target = e.currentTarget
        let data = {
            action: 'ajax_login',
            nonce: target.getAttribute('data-nonce'),
            product_id: target.getAttribute('data-product-id'),
            user: user,
            password: password,
        }

        target.classList.toggle('pending')
        const response = await post(data)
    })
})