document.addEventListener('DOMContentLoaded', () => {
    // Filter category
    let btnCategory = document.querySelector('#btn-filter')
    let homeCategory = document.querySelector('#home-category')
    let homeOverlay = document.querySelector('#home-category .overlay')

    btnCategory.addEventListener('click', (e) => {
        e.preventDefault()
        homeCategory.classList.toggle('active')
    })
    homeOverlay.addEventListener('click', (e) => {
        e.preventDefault()
        homeCategory.classList.toggle('active')
    })
})
