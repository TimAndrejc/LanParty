<?php
if(isset($_GET['add'])){
  if($_GET['add'] == 'true'){
    ?>
    <script src="https://unpkg.com/sweetalert2"></script> 
<script>Swal.fire({
      title: 'Poišči igralca',
      html:
      '<input id="swal-input1" autocomplete="off" placeholder="Uporabniško ime" class="swal2-input">' +
      '<input id="swal-input2" autocomplete="off" placeholder ="Tag"class="swal2-input"><br><section style="opacity: 60%">Ime#tag (tag napiši brez #)</section>',
      focusConfirm: false,
      required: true,
      showCancelButton: true,
      confirmButtonText: 'Dodaj',
      cancelButtonText: 'Prekliči',
      showLoaderOnConfirm: true,
      preConfirm: function () {
                return new Promise(function (resolve) {
                    // Validate input
                    if ($('#swal-input1').val() == '' || $('#swal-input2').val() == '') {
                        swal.showValidationMessage("Izpolni obe polji!")
                        swal.enableButtons()
                        swal.hideLoading();
                        
                    } else {
                        swal.resetValidationMessage(); 
                        resolve([
                            $('#swal-input1').val(),
                            $('#swal-input2').val()
                        ]);
                    }
                })
            },
            onOpen: function () {
                $('#swal-input1').focus()
            }
        }).then(function (result) {
            if (typeof(result.value) == 'undefined') {
                return false;
            }
            console.log(result.value);
            var username = result.value[0];
            var tag = result.value[1];
            $.ajax({
                url: 'add_teammate.php',
                type: 'POST',
                data: {
                    username: username,
                    tag: tag,
                    team_id : <?php echo $_GET['id']; ?>
                },
                success: function (data) {
                    if (data == 'true') {
                       new swal({
                            title: 'Uspešno dodan igralec!',
                            type: 'success',
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500
                        }).then(function () {
                            window.location.href = 'team.php?id=<?php echo $_GET['id']; ?>';
                        });
                    } else {
                        new swal({
                            title: 'Napaka!',
                            text: 'Igralec ne obstaja ali pa je že v skupini!',
                            type: 'error',
                            icon: 'error',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500
                        }).then(function () {
                            window.location.href = 'team.php?id=<?php echo $_GET['id']; ?>';
                        });
                    }
                }
            });
        }).catch(swal.noop);
        </script>
    <?php
}
}