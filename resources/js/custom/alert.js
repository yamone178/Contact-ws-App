import Swal from 'sweetalert2'


window.confirmAlert =(message , form) =>{
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: message
    }).then((result) => {
        if (result.isConfirmed) {

            form.submit();
        }
    })
}

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

window.errorAlert = (message, icon, title)  =>{
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
    })
}

