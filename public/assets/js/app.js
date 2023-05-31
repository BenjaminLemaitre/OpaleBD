let checkbars = document.querySelector('.checkbars');

checkbars.addEventListener('click', () => {
    if (checkbars.checked) {
        document.body.style.overflow = 'hidden';
    }
    else {
        document.body.style.overflow = 'visible'
    }
})