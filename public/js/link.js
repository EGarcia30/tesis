const linkItems = document.querySelectorAll('.nav_link');

linkItems.forEach((linkItem, index) => {
    linkItem.addEventListener('click', () => {
        document.querySelector('.active').classList.remove('active');
        linkItem.classList.add('active');
    })
})