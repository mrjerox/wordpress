window.addEventListener('DOMContentLoaded', () => {
    // Filter category
    const btnCategory = document.querySelector('#btn-filter')
    const homeCategory = document.querySelector('#home-category')
    const homeOverlay = document.querySelector('#home-category .overlay')

    btnCategory.addEventListener('click', (e) => {
        e.preventDefault()
        homeCategory.classList.toggle('active')
    })
    homeOverlay.addEventListener('click', (e) => {
        e.preventDefault()
        homeCategory.classList.toggle('active')
    })
    
    // Order by
    const selectFilter = document.querySelector('#select-order')
    selectFilter.addEventListener('change', (e) => {
        e.preventDefault()
        let value = e.currentTarget.value;
        let url = new URL(window.location.href)
        url.searchParams.delete('order');
        window.location.href = url + '?order=' + value 
    })
})