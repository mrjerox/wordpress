document.addEventListener('DOMContentLoaded', () => {
    // Filter category
    let btnCategory = document.querySelector('#btn-filter')
    let homeCategory = document.querySelector('#home-category')
    let homeOverlay = homeCategory.querySelectorAll(':scope .overlay')

    btnCategory.addEventListener('click', (e) => {
        e.preventDefault()
        homeCategory.classList.toggle('active')
    })
    homeOverlay[0].addEventListener('click', (e) => {
        e.preventDefault()
        homeCategory.classList.toggle('active')
    })
})
