<?php
if(isset($_GET['add_to_tourney'])){
    $query = "SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $team = $stmt->fetch();
    if($_SESSION['id'] != $team['creator_id']){
        header("Location: index.php");
        die();
    }
  ?>
  <script> Swal.fire({
    title: 'Prijava ekipe',
    html : 'Izberi igro: <br><select class="swal2-input" style ="width: 70%;" id="game" name="game"><option value="1">Valorant</option><option value="2">League of Legends</option><option value="3">Oboje</option></select>',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Prijavi!',
    cancelButtonText: 'Prekliči',
    preConfirm: function () {
                return new Promise(function (resolve) {
                    // Validate input
                    if ($('#swal-input1').val() == '') {
                        swal.showValidationMessage("Neveljavno!")
                        swal.enableButtons()
                        swal.hideLoading();
                        
                    } else {
                        swal.resetValidationMessage(); 
                        resolve([
                            $('#game').val()
                        ]);
                    }
                })
            },
            onOpen: function () {
                $('#game').focus()
            }
        }).then(function (result) {
            if (typeof(result.value) == 'undefined') {
                return false;
            }
            console.log(result.value);
            var game = result.value[0]
            $.ajax({
                url: 'add_to_tourney.php',
                type: 'POST',
                data: {
                    team: <?php echo $_GET['id']; ?>,
                    game: game
                },
                success: function (data) {
                    if (data == 'true') {
                        Swal.fire({
                            title: 'Uspešno prijavljena ekipa!',
                            type: 'success',
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            title: 'Prijava ni uspela!',
                            type: 'error',
                            icon: 'error',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500
                        });
                    }
                }
            });
            setTimeout(function () {
                <?php
                echo "window.location.href = 'team.php?id=" . $_GET['id'] . "'";
                ?>
            }, 2000);
        });
    </script>
    <?php
}
?>
<?php
