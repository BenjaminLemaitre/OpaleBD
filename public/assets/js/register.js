let genreOne = document.querySelector('.genreone');
let genreTwo = document.querySelector('.genretwo');

let checkOne = document.getElementById('register_gender_0');
let checkTwo = document.getElementById('register_gender_1');
let check = [checkOne, checkTwo];

console.log(checkOne);

check.forEach(checkItem => {
    checkItem.addEventListener('change', ()=>{
        if(checkTwo.checked){
            genreTwo.classList.replace('btn-outline-danger', 'btn-danger')
            genreOne.classList.replace('btn-primary', 'btn-outline-primary')
        }
        else{
            genreTwo.classList.replace('btn-danger', 'btn-outline-danger')
            genreOne.classList.replace('btn-outline-primary', 'btn-primary')
        }
    });

});