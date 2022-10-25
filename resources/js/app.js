import './bootstrap';
import '../css/app.css';
import './custom/createAndChangeImg'
import './custom/checkBoxes'
import './custom/alert'


window.forward=(route)=>{
    location.href = route
}

// let multipleForm = document.querySelector('.multipleForm')

let clone= document.querySelector('.clone')
clone.addEventListener('click',function (e){

    e.preventDefault()
    multipleForm.setAttribute('action',"http://127.0.0.1:8000/multiple-clone")
    // multipleForm.submit();
    // multipleForm.getAttribute('action', "{{route('contact.multiple-clone')}}")
});



