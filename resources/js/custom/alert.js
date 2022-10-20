import Swal from 'sweetalert2'

let multipleDelBtn= document.querySelector('.multipleDelBtn')

multipleDelBtn.addEventListener('click',function (e){
    e.preventDefault()
    let form= e.target.parentElement
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            showToast('contacts are deleted')

            setTimeout(()=>{
                form.submit();
            },2000)


        }
    })
})

window.showToast = function (message){
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: message
    })
}
