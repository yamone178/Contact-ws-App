let contactImgInput= document.querySelector('.contact-imgInput');
let createContact= document.querySelector('.create-contact-img svg')

if (createContact){
    createContact.addEventListener('click',()=>{
        console.log('click')
        contactImgInput.click()
    })
}


let contactImgArea= document.querySelector('.contact-Img-area')
let outputImg= document.querySelector('.outputImg');

if (contactImgInput){
    contactImgInput.addEventListener('change',function (){
        let currentFile=  this.files[0];


        let reader= new FileReader();
        reader.onload=function (e){

            console.log(e.target.result);
            contactImgArea.classList.add('d-none')
            outputImg.classList.remove('d-none')
            outputImg.classList.add('d-block')
            outputImg.src= e.target.result

        }
        reader.readAsDataURL(currentFile)
    })

}

