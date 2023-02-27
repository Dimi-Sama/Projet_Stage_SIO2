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

    <title>Modifier styles </title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</head>

<body>
    <?php include 'asset/lib/navbar.php' ?>
    <!-- Add Style -->
    <div class="modal fade" id="addStyle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un Style</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveStyle">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Nom :</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Image :</label>
                            <input type="file" name="image" class="form-control" />
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

    <!-- Edit Style -->
    <div class="modal fade" id="editStyle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Style</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateStyle">
                    <div class="modal-body">

                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idStyle" id="idStyle">

                        <div class="mb-3">
                            <label for="">Nom :</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Image :</label>
                            <input type="file" name="image" class="form-control" />
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
                        <h4>Gestion styles

                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addStyle">
                                Nouveau Style
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form id="updateLimite">

                                <div class="mb-3">

                                <?php

                                $conn = $bd->connect();

                                $sql = "SELECT limStyle FROM limite";
                                $req = $conn->prepare($sql);
                                $req->execute();
                                $limite = $req->fetch(PDO::FETCH_ASSOC);
                                ?>
                                    <label for="">Limite utilisateur :</label>
                                    <input type="number" name="limite" id="limite" class="form-control" value="<?php echo $limite['limStyle'] ?>" />
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <br>

                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $conn = $bd->connect();

                                $sql = "SELECT * FROM style";
                                $req = $conn->prepare($sql);
                                $req->execute();

                                if ($req->rowCount() > 0) {
                                    foreach ($req as $Style) {
                                ?>
                                        <tr>
                                            <td><?= $Style['id'] ?></td>
                                            <td><?= $Style['libelle'] ?></td>
                                            <td><img src="../../asset/imgStyle/<?= $Style['img'] ?>" class="rounded" style="width:150px; " alt=""></td>
                                            <td>
                                                <button type="button" value="<?= $Style['id']; ?>" class="editStyleBtn btn btn-success btn-sm">Edit</button>
                                                <button type="button" value="<?= $Style['id'] . "/" . $Style['img']; ?>" class="deleteStyleBtn btn btn-danger btn-sm">Delete</button>
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
        $(document).on('submit', '#saveStyle', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("saveStyle", true);

            $.ajax({
                type: "POST",
                url: "bin/codeStyle.php",
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
                        $('#addStyle').modal('hide');
                        $('#saveStyle')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStyleBtn', function() {

            var idStyle = $(this).val();

            $.ajax({
                type: "GET",
                url: "bin/codeStyle.php?idStyle=" + idStyle,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#idStyle').val(res.data.id);

                        $('#editStyle').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateStyle', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateStyle", true);

            $.ajax({
                type: "POST",
                url: "bin/codeStyle.php",
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

                        $('#editStyle').modal('hide');
                        $('#updateStyle')[0].reset();

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
                url: "bin/codeStyle.php",
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



        $(document).on('click', '.deleteStyleBtn', function(e) {
            e.preventDefault();

            if (confirm('Supprimer ??')) {
                var idStyle = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "bin/codeStyle.php",
                    data: {
                        'deleteStyle': true,
                        'idStyle': idStyle
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