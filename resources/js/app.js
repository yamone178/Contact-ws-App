import './bootstrap';
import '../css/app.css';
import './custom/createAndChangeImg'
import './custom/checkBoxes'
import './custom/alert'


window.forward=(route)=>{
    location.href = route
}

let multiSelectForm = document.querySelector('.multipleForm')
let multipleDelBtn= document.querySelector('.multipleDelBtn')
let formBtns =document.querySelectorAll('.formBtn')



if (multipleDelBtn){
    multipleDelBtn.addEventListener('click',function (e){
        e.preventDefault()
        let form= e.target.parentElement
        window.confirmAlert('Yes, delete it',form)
    })
}

if (formBtns){
    formBtns.forEach(formBtn => {

        formBtn.addEventListener('click',function (e){
            e.preventDefault()

        })
    })

}

window.changeRoute = (route, message = 'Are you sure') =>{
    multiSelectForm.action = route
    window.confirmAlert(message, multiSelectForm)
}



