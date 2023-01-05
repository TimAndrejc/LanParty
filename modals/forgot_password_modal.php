<?php
if(isset($_GET['forgotPassword'])){
?>
    <script src="https://unpkg.com/sweetalert2"></script> 
<script>Swal.fire({
  title: 'Vnesi svoj Email',
  input: 'email',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Pošlji',
  cancelButtonText: 'Prekliči',
  showLoaderOnConfirm: true,
  preConfirm: (login) => {
    $.ajax({
        url: 'forgot_password.php',
        type: 'POST',
        data: {
            email: login
        },
        success: function (data) {
            if (data == 'true') {
                Swal.fire({
                    title: 'Email poslan!',
                    text: 'Prosimo, da pogledate svoj Email.',
                    icon: 'success'
                })
            } else {
                Swal.fire({
                    title: 'Napaka!',
                    text: 'Uporabnik s tem Emailom ne obstaja.',
                    icon: 'error'
                })
            }
        }
    })  
    },
    allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Email poslan!',
                text: 'Prosimo, da pogledate svoj Email.',
                icon: 'success'
            })
        }
    })
</script>
<?php
}
?>