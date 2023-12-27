document.addEventListener('DOMContentLoaded', () => {
    // Handle login
    const btnLogin = document.querySelector('#btn-login')
    btnLogin.addEventListener('click', async (e) => {
        e.preventDefault()
        const user = document.querySelector('#email')
        const password = document.querySelector('#password')
        let target = e.currentTarget
        let data = {
            action: 'ajax_login',
            nonce: target.getAttribute('data-nonce'),
            product_id: target.getAttribute('data-product-id'),
            username: user.value,
            password: password.value,
        }

        target.classList.toggle('pending')
        const response = await post(data)

        if (response.success) {
            target.classList.toggle('pending')
            window.location.href = obj.ACCOUNT_URL
            return
        }

        target.classList.toggle('pending')
        document.querySelector('#login-message').innerHTML = response.data
        console.log(response);
        return
    })

    // Handle register
    const btnRegister = document.querySelector('#btn-register')
    btnRegister.addEventListener('click', async (e) => {
        e.preventDefault()
        const user = document.querySelector('#register-email')
        const password = document.querySelector('#register-password')
        const repassword = document.querySelector('#register-repassword')

        let target = e.currentTarget
        let data = {
            action: 'ajax_register_customer',
            nonce: target.getAttribute('data-nonce'),
            product_id: target.getAttribute('data-product-id'),
            email: user.value,
            password: password.value,
        }

        if (checkRequired([user, password, repassword])) {
            checkLength(user, 3, 15);
            checkLength(password, 6, 25);
            checkEmail(user);
            checkPasswordsMatch(password, repassword);
        }

        target.classList.toggle('pending')
        const response = await post(data)

        if (response.success) {
            target.classList.toggle('pending')
            window.location.href = obj.ACCOUNT_URL
            return
        }

        target.classList.toggle('pending')
        document.querySelector('#login-message').innerHTML = response.data
        console.log(response);
        return
    })
})