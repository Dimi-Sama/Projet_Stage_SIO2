<?php
    session_start();

    if (!isset($_SESSION['Admin']) || $_SESSION['Admin'] != true){
        header('Location: ../403');
    }else {
    }

    require '../lib/Parsedown.php';
    $Parsedown = new Parsedown();
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <title>Modifier Forfaits </title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>
<?php include 'asset/lib/navbar.php'?>
<!-- Add Forfait -->
<div class="modal fade" id="addForfait" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un Forfait</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveForfait">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Nom :</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Description : (Markdown)</label>
                    <textarea class="form-control" name="desc" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Prix :</label>
                    <input type="number" name="prix" class="form-control" step=".01"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Forfait -->
<div class="modal fade" id="editForfait" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Forfait</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateForfait">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="idForfait" id="idForfait" >

                <div class="mb-3">
                    <label for="">Nom :</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Description : (Markdown)</label>
                    <textarea class="form-control" name="desc" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Prix :</label>
                    <input type="number" name="prix" class="form-control" step=".01"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Gestion Forfaits
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addForfait">
                            Nouveau Forfait
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            include 'bin/dbConnect.php';
                            $bd = new DbConnect();
                            $conn = $bd->connect();

                            $sql = "SELECT * FROM forfait";
                            $req = $conn->prepare($sql);
                            $req->execute();

                            if($req->rowCount() > 0)
                            {
                                foreach($req as $Forfait)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $Forfait['id'] ?></td>
                                        <td><?= $Forfait['libelle'] ?></td>
                                        <td style="white-space: pre-wrap"><?= $Parsedown->text($Forfait['description']) ?></td>
                                        <td><?= $Forfait['prix'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$Forfait['id'];?>" class="editForfaitBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$Forfait['id'];?>" class="deleteForfaitBtn btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveForfait', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("saveForfait", true);

            $.ajax({
                type: "POST",
                url: "bin/codeForfait.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 0) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 1){

                        $('#errorMessage').addClass('d-none');
                        $('#addForfait').modal('hide');
                        $('#saveForfait')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editForfaitBtn', function () {

            var idForfait = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "bin/codeForfait.php?idForfait=" + idForfait,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#idForfait').val(res.data.id);

                        $('#editForfait').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateForfait', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateForfait", true);

            $.ajax({
                type: "POST",
                url: "bin/codeForfait.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 0) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 1){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#editForfait').modal('hide');
                        $('#updateForfait')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });



        $(document).on('click', '.deleteForfaitBtn', function (e) {
            e.preventDefault();

            if(confirm('Supprimer ??'))
            {
                var idForfait = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "bin/codeForfait.php",
                    data: {
                        'deleteForfait': true,
                        'idForfait': idForfait
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 2) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>