let check = document.querySelectorAll('.form-check-label');
let formcheck = document.querySelectorAll('.form-check-input');
let labelContainer = document.querySelectorAll('.label-container');


formcheck.forEach((checkbox, k)=>{
    if (checkbox.checked){
        labelContainer[k].classList.add("bg-custom")
    }
})

check.forEach((item, i)=>{
    item.addEventListener("click", ()=>{
        if (formcheck[i].checked){
            labelContainer[i].classList.remove("bg-custom")
        }
        else {
            labelContainer[i].classList.add("bg-custom") 
        }
    })
})