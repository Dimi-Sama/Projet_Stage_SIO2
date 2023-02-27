<?php
    session_start();

    if (!isset($_SESSION['Admin']) || $_SESSION['Admin'] != true){
        header('Location: ../403');
    }else {
    }
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <title>Modifier secteurs d'activités</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>
<?php include 'asset/lib/navbar.php'?>
<!-- Add Secteur -->
<div class="modal fade" id="addSecteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un secteur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveSecteur">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Nom :</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Description :</label>
                    <input type="text" name="desc" class="form-control" />
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

<!-- Edit Secteur -->
<div class="modal fade" id="editSecteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Secteur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateSecteur">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="idSecteur" id="idSecteur" >

                <div class="mb-3">
                    <label for="">Nom :</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Description :</label>
                    <input type="text" name="desc" class="form-control" />
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

<!-- View Secteur Modal -->
<div class="modal fade" id="seeSecteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Secteur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Nom :</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Description :</label>
                    <input type="text" name="desc" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Gestion secteurs
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addSecteur">
                            Nouveau Secteur
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            include 'bin/dbConnect.php';
                            $bd = new DbConnect();
                            $conn = $bd->connect();

                            $sql = "SELECT * FROM secteuract";
                            $req = $conn->prepare($sql);
                            $req->execute();

                            if($req->rowCount() > 0)
                            {
                                foreach($req as $secteur)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $secteur['id'] ?></td>
                                        <td><?= $secteur['libelle'] ?></td>
                                        <td><?= $secteur['description'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$secteur['id'];?>" class="editSecteurBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$secteur['id'];?>" class="deleteSecteurBtn btn btn-danger btn-sm">Delete</button>
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
        $(document).on('submit', '#saveSecteur', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("saveSecteur", true);

            $.ajax({
                type: "POST",
                url: "bin/codeSecteur.php",
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
                        $('#addSecteur').modal('hide');
                        $('#saveSecteur')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editSecteurBtn', function () {

            var idSecteur = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "bin/codeSecteur.php?idSecteur=" + idSecteur,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#idSecteur').val(res.data.id);

                        $('#editSecteur').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateSecteur', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateSecteur", true);

            $.ajax({
                type: "POST",
                url: "bin/codeSecteur.php",
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
                        
                        $('#editSecteur').modal('hide');
                        $('#updateSecteur')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });



        $(document).on('click', '.deleteSecteurBtn', function (e) {
            e.preventDefault();

            if(confirm('Supprimer ??'))
            {
                var idSecteur = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "bin/codeSecteur.php",
                    data: {
                        'deleteSecteur': true,
                        'idSecteur': idSecteur
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