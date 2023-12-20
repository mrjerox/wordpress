document.addEventListener('DOMContentLoaded', () => {
    // Menu
    let btnMenu = document.querySelector('#btn-menu')
    let mobileMenu = document.querySelector('#mobile-menu')
    let page = document.querySelector('#page')
    
    btnMenu.addEventListener('click', (e) => {
        e.preventDefault();
        mobileMenu.classList.toggle('active')
        page.classList.toggle('disable')
    })

    // Search
    let btnSearch = document.querySelector('#btn-search')
    let boxSearch = document.querySelector('#search')
    let searchOverlay = boxSearch.querySelectorAll(':scope .overlay')
    
    btnSearch.addEventListener('click', (e) => {
        e.preventDefault()
        boxSearch.classList.toggle('active')
    })
    searchOverlay[0].addEventListener('click', (e) => {
        e.preventDefault()
        boxSearch.classList.toggle('active')
    })
})