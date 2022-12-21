<?php 

if(!isset($_SESSION['admin'])){
    header('Location: index.php');
    exit;
}
?>
<script>
    Swal.fire({
        title: 'Izbris uporabnika',
        text: 'Ste prepričani da želite izbrisati uporabnika?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#d33', 
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Izbriši',
        cancelButtonText: 'Prekliči'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Izbrisano!',
                text: 'Igralec je bil izbrisan.',
                icon: 'success',
                showConfirmButton: false,
                allowOutsideClick: false,
            })
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: {
                    user: <?php echo $_GET['userId']; ?>
                }
            });
            setTimeout(function(){
                window.location.href = 'admin.php';
            }, 2000);
        }else{
            window.location.href = 'admin.php';
        }
    })
</script>