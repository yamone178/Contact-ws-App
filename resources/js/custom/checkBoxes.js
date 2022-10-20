

let checkAll= document.getElementById('flexCheckDefault');
let checkBoxes= document.querySelectorAll('.check-box');


window.selectItems = []


if (checkAll){
    checkAll.addEventListener('click',function (){

        if (checkAll.checked == true){
            checkBoxes.forEach((check)=>{

                check.checked =true

            })
        }

        if (checkAll.checked == false){
            checkBoxes.forEach((check)=>{
                check.checked = false
            })
        }

    })
}


    checkBoxes.forEach((check)=>{
        check.addEventListener('change',function (e){
            if (e.target.checked == true){
                selectItems.push(e.target.id)
                console.log(selectItems)

            }

            if (e.target.checked == false && selectItems.includes(e.target.id)){
                getSelectItemsCount(e.target.id)
            }

        })
    })


function getSelectItemsCount(id) {
    let index=   selectItems.findIndex((i)=> i== id )
  return   selectItems.splice(index, 1)

}
