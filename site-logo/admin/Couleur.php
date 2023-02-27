<?php
session_start();

if (!isset($_SESSION['Admin']) || $_SESSION['Admin'] != true) {
    header('Location: ../403');
} else {
}
include 'bin/dbConnect.php';
$bd = new DbConnect();
?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Modifier Couleurs </title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</head>

<body>
    <?php include 'asset/lib/navbar.php' ?>
    <!-- Add Couleur -->
    <div class="modal fade" id="addCouleur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une Couleur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveCouleur">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Nom :</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Couleur :</label>
                            <input type="color" name="couleur" class="form-control" />
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

    <!-- Edit Couleur -->
    <div class="modal fade" id="editCouleur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Couleur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateCouleur">
                    <div class="modal-body">

                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idCouleur" id="idCouleur">

                        <div class="mb-3">
                            <label for="">Nom :</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Couleur :</label>
                            <input type="color" name="couleur" class="form-control" />
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

    <!-- View Couleur Modal -->
    <div class="modal fade" id="seeCouleur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Couleur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="">Nom :</label>
                        <p id="view_name" class="form-control"></p>
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
                        <h4>Gestion couleurs

                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addCouleur">
                                Nouveau Couleur
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="updateLimite">

                            <div class="mb-3">

                                <?php

                                $conn = $bd->connect();

                                $sql = "SELECT limCouleur FROM limite";
                                $req = $conn->prepare($sql);
                                $req->execute();
                                $limite = $req->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <label for="">Limite utilisateur :</label>
                                <input type="number" name="limite" id="limite" class="form-control" value="<?php echo $limite['limCouleur'] ?>" />
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Code Hex</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $conn = $bd->connect();

                                $sql = "SELECT * FROM couleur";
                                $req = $conn->prepare($sql);
                                $req->execute();

                                if ($req->rowCount() > 0) {
                                    foreach ($req as $Couleur) {
                                ?>
                                        <tr>
                                            <td><?= $Couleur['id'] ?></td>
                                            <td><?= $Couleur['libelle'] ?></td>
                                            <td class="custom-color" style="color:<?= $Couleur['codeHexa'] ?>"><?= $Couleur['codeHexa'] ?></td>
                                            <td>
                                                <button type="button" value="<?= $Couleur['id']; ?>" class="editCouleurBtn btn btn-success btn-sm">Edit</button>
                                                <button type="button" value="<?= $Couleur['id']; ?>" class="deleteCouleurBtn btn btn-danger btn-sm">Delete</button>
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
        $(document).on('submit', '#saveCouleur', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("saveCouleur", true);

            $.ajax({
                type: "POST",
                url: "bin/codeCouleur.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 0) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 1) {

                        $('#errorMessage').addClass('d-none');
                        $('#addCouleur').modal('hide');
                        $('#saveCouleur')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editCouleurBtn', function() {

            var idCouleur = $(this).val();

            $.ajax({
                type: "GET",
                url: "bin/codeCouleur.php?idCouleur=" + idCouleur,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#idCouleur').val(res.data.id);

                        $('#editCouleur').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateCouleur', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateCouleur", true);

            $.ajax({
                type: "POST",
                url: "bin/codeCouleur.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 0) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    } else if (res.status == 1) {

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#editCouleur').modal('hide');
                        $('#updateCouleur')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('submit', '#updateLimite', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateLimite", true);

            $.ajax({
                type: "POST",
                url: "bin/codeCouleur.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 0) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    } else if (res.status == 1) {

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                    } else if (res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });



        $(document).on('click', '.deleteCouleurBtn', function(e) {
            e.preventDefault();

            if (confirm('Supprimer ??')) {
                var idCouleur = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "bin/codeCouleur.php",
                    data: {
                        'deleteCouleur': true,
                        'idCouleur': idCouleur
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 2) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
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