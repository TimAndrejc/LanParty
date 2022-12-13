<?php
if(isset($_GET['add'])){
  if($_GET['add'] == 'true'){
    echo "<script>Swal.fire({
      title: 'Poišči igralca',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      inputPlaceholder: 'Uporabniško ime',
      inputValidator: (value) => {
        if (!value) {
          return 'Vnesi uporabniško ime!'
        }
      },
      showCancelButton: true,
      confirmButtonText: 'Dodaj',
      cancelButtonText: 'Prekliči',
      showLoaderOnConfirm: true,
      preConfirm: (user) => {
        return fetch(`add.php?user=${user}&team=".$_GET['id']."`)
          .then(response => {
            if (!response.ok) {
              throw new Error(response.statusText)
            }
            return response.json()
          })
          .catch(error => {
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Dodan/a!',
          'Igralec je dodan v ekipo.',
          'success'
        )
      }
    });</script>";
}
}