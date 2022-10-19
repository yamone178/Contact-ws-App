let checkAll= document.querySelector('.checkAll');
let checkBoxes= document.querySelectorAll('.check-box');


if (checkAll){
    checkAll.addEventListener('click',function (){
        if (checkAll.checked == true){
            console.log('hellow')
            // checkBoxes.forEach((check)=>{
            //     check.checked =true
            // })
        }

        if (checkAll.checked == false){
            checkBoxes.forEach((check)=>{
                check.checked = false
            })
        }

    })
}
