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
let clone =document.querySelector('.clone')



if (multipleDelBtn){
    multipleDelBtn.addEventListener('click',function (e){
        e.preventDefault()
        let form= e.target.parentElement
        window.confirmAlert('Yes, delete it',form)
    })
}

if (clone){
    clone.addEventListener('click',function (e){
        e.preventDefault()

    })
}

window.changeRoute = (route) =>{
    multiSelectForm.action = route
    window.confirmAlert('copy it', multiSelectForm)
}



