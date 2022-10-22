

let checkAll= document.getElementById('flexCheckDefault');
let checkBoxes= document.querySelectorAll('.check-box');
let count= document.querySelector('.count');

let selectItems = []


function getSelectItemsCount(id) {
    let index=   selectItems.findIndex((i)=> i== id )
    selectItems.splice(index, 1)
    return selectItems;

}

function checked(checkBox){
    if (checkBox.checked == true && !selectItems.includes(checkBox.id)){
        selectItems.push(checkBox.id)
        count.innerHTML = selectItems.length

    }
}

function unChecked(checkBox){
    if (checkBox.checked == false && selectItems.includes(checkBox.id)){
        getSelectItemsCount(checkBox.id)
        count.innerHTML = selectItems.length
    }

}




if (checkAll){
    checkAll.addEventListener('click',function (){

        if (checkAll.checked == true){
            checkBoxes.forEach((check,index)=>{
               check.checked = true
                checked(check)
                })

        }

        if (checkAll.checked == false){
            checkBoxes.forEach((check, index)=>{
                    check.checked = false
                    unChecked(check)
            })
        }

    })
}


//Select Item count

checkBoxes.forEach((check)=>{
    check.addEventListener('change',function (e){
        checked(e.target)
        unChecked(e.target)
            })

    })





