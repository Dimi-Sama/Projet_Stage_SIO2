<?php
session_start();

if (!isset($_SESSION['Admin']) || $_SESSION['Admin'] != true) {
    header('Location: ../../403');
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

    <title>Commandes </title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include 'asset/lib/navbar.php' ?>

    <!-- Edit Commande -->
    <div class="modal fade" id="editCommande" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateCommande">
                    <input type="hidden" name="idCommande" id="idCommande">
                    <div class="modal-body">

                        <?php
                        $conn = $bd->connect();
                        $sql = "SELECT id,libelle FROM etat";
                        $reqq = $conn->prepare($sql);
                        $reqq->execute(); ?>
                        <div class="mb-3">
                            <label for="">Etat : </label>
                            <select id="idEtat" name="idEtat">

                                <?php foreach ($reqq as $etat) {  ?>

                                    <option value="<?= $etat['id'] ?>"> <?= utf8_encode($etat['libelle']) ?></option>

                                <?php     }  ?>
                            </select>
                        </div>
                        <div id="imageFinal" class="mb-3">
                            <label for="">Image :</label>
                            <input type="file" name="imageFinal" class="form-control" />
                        </div>
                        <script>
                            $('#imageFinal').hide();
                            $('#idEtat').change(function() {
                                var id = $(this).val();

                                if (id == 3) {
                                    $('#imageFinal').show();
                                    $("#btnSub").hide();
                                } else {
                                    $('#imageFinal').hide();
                                    $("#btnSub").show();
                                }
                            })
                            $('#imageFinal').change(function(){
                                if ($(this).val != "") {
                                    $("#btnSub").show();
                                }else{

                                }
                            })
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnSub" class="btn btn-primary">Update</button>
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
                        <h4>Gestion Commandes
                            <a href='bin/saveUser.php' type="button" class="btn btn-primary float-end">
                                Liste Users
                            </a>
                        </h4>
                    </div>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['idUser'])) {

                        $conn = $bd->connect();
                        $sql = "SELECT id,nom,prenom FROM users";
                        $req = $conn->prepare($sql);
                        $req->execute(); ?>
                        <div class="card-body">
                            <form action="commande.php" method="post">
                                <select name="idUser">

                                    <?php foreach ($req as $user) {  ?>

                                        <option value="<?= $user['id'] ?>"><?= $user['id'] . "- " . $user['nom'] . "-" . $user['prenom'] ?></option>

                                    <?php     }  ?>
                                </select>
                                <button type="submit">Valider</button>
                            </form>
                        </div>

                    <?php } else {
                        $_SESSION['idUser'] = $_POST['idUser'];

                        $conn = $bd->connect();
                        $sql = "SELECT id,nom,prenom FROM users";
                        $req = $conn->prepare($sql);
                        $req->execute(); ?>


                        <div class="card-body">

                            <form action="commande.php" method="post">
                                <select name="idUser">

                                    <?php foreach ($req as $user) {  ?>

                                        <option value="<?= $user['id'] ?>"><?= $user['id'] . "- " . $user['nom'] . "-" . $user['prenom'] ?></option>

                                    <?php     }  ?>
                                </select>
                                <button type="submit">Valider</button>
                            </form>
                        </div>

                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>User</th>
                                    <th>Nom sur le logo</th>
                                    <th>Logo fourni</th>
                                    <th>Secteur d'activité</th>
                                    <th>Style de logo</th>
                                    <th>Couleur(s)</th>
                                    <th>Style(s)</th>
                                    <th>Forfait</th>
                                    <th>Statut</th>
                                    <th>Logo final</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $conn = $bd->connect();
                                $idUser = $_SESSION['idUser'];

                                $sql = "SELECT * FROM commandes where idUser = :id";
                                $req = $conn->prepare($sql);
                                $req->bindParam(':id', $idUser);
                                $req->execute();

                                if ($req->rowCount() > 0) {
                                    foreach ($req as $Commande) {
                                ?>
                                        <tr>
                                            <td><?= $Commande['numero'] ?></td>
                                            <td><?= $Commande['idUser'] ?></td>
                                            <td><?= $Commande['nomLogo'] ?></td>
                                            <td style="align-items: center;">
                                                <?php
                                                if ($Commande['logoUser'] == NULL) {
                                                    echo "Pas d'image fourni";
                                                } else {
                                                    echo "<img style='height: 80px; border: 2px solid #333;  aspect-ratio: 1 / 1;
                                                object-fit: cover;' src=" . '../../asset/imgLogoUser/' . $Commande['logoUser'] . ">";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $id = $Commande['idSecteur'];
                                                $sql = "SELECT libelle FROM secteuract WHERE id= :id";
                                                $req = $conn->prepare($sql);
                                                $req->bindParam(':id', $id);
                                                $req->execute();
                                                $secteur = $req->fetch(PDO::FETCH_ASSOC);
                                                echo $secteur['libelle'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $id = $Commande['idStyleLogo'];
                                                $sql = "SELECT libelle, img FROM stylelogo WHERE id= :id";
                                                $req = $conn->prepare($sql);
                                                $req->bindParam(':id', $id);
                                                $req->execute();
                                                $logo = $req->fetch(PDO::FETCH_ASSOC);
                                                echo "<p>" . $logo['libelle'] . "</p>
                                                <img style='height: 80px; border: 2px solid #333 ; aspect-ratio: 1 / 1;
                                                object-fit: cover;' src=" . '../../asset/imgLogo/' . $logo['img'] . ">"
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $listCouleur = explode("/", $Commande["idCouleur"]);
                                                foreach ($listCouleur as $couleur) {
                                                    if ($couleur == "") {
                                                    } elseif ($couleur == "on") {
                                                        echo "<p style='color:" . $Commande['couleurCustom'] . "'> Couleur personalisé : " . $Commande['couleurCustom'] . " </p>";
                                                    } else {
                                                        $sql = "SELECT libelle FROM couleur WHERE id= :id";
                                                        $req = $conn->prepare($sql);
                                                        $req->bindParam(':id', $couleur);
                                                        $req->execute();
                                                        $logo = $req->fetch(PDO::FETCH_ASSOC);
                                                        echo "<p>" . $logo['libelle'] . "</p>";
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td id="Simg">
                                                <?php
                                                $listStyle = explode("/", $Commande["idStyle"]);
                                                foreach ($listStyle as $style) {
                                                    if ($style == "") {
                                                    } else {
                                                        $sql = "SELECT img FROM style WHERE id= :id";
                                                        $req = $conn->prepare($sql);
                                                        $req->bindParam(':id', $style);
                                                        $req->execute();
                                                        $logo = $req->fetch(PDO::FETCH_ASSOC);
                                                        echo "<img style='height: 80px; border: 2px solid #333 ; aspect-ratio: 1 / 1;
                                                  object-fit: cover;' src=" . '../../asset/imgStyle/' . $logo['img'] . " />";
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $id = $Commande["idForfait"];
                                                $sql = "SELECT libelle FROM forfait WHERE id= :id";
                                                $req = $conn->prepare($sql);
                                                $req->bindParam(':id', $id);
                                                $req->execute();
                                                $forfait = $req->fetch(PDO::FETCH_ASSOC);
                                                echo $forfait['libelle'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $id = $Commande["idEtat"];
                                                $sql = "SELECT libelle FROM etat WHERE id= :id";
                                                $req = $conn->prepare($sql);
                                                $req->bindParam(':id', $id);
                                                $req->execute();
                                                $etat = $req->fetch(PDO::FETCH_ASSOC);
                                                echo utf8_encode($etat['libelle']);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($Commande['logoFinal'] == "" || $Commande['logoFinal'] == NULL) {
                                                    echo "Pas encore terminé";
                                                } else
                                                echo"
                                                <img style='height: 80px; border: 2px solid #333 ; aspect-ratio: 1 / 1;
                                                object-fit: cover;' src=" . '../../asset/imgLogoFinal/' . $Commande['logoFinal'] . ">"
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" value="<?= $Commande['numero']; ?>" class="editCommandeBtn btn btn-success btn-sm">Edit</button>
                                                <button type="button" value="<?= $Commande['numero']; ?>" class="deleteCommandeBtn btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            <?php  }
                            ?>

                            </tbody>
                        </table>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('click', '.editCommandeBtn', function() {

            var idCommande = $(this).val();

            $.ajax({
                type: "GET",
                url: "bin/codeCommande.php?idCommande=" + idCommande,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#idCommande').val(res.data.numero);

                        $('#editCommande').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateCommande', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateCommande", true);

            $(document).ajaxStart(function() {
                $(document.body).css({
                    'cursor': 'wait'
                });
                $("#btnSub").attr('class', "btn btn-primary disabled");
            }).ajaxStop(function() {
                $(document.body).css({
                    'cursor': 'default'
                });
                $("#btnSub").attr('class', "btn btn-primary");
            });

            $.ajax({
                type: "POST",
                url: "bin/codeCommande.php",
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

                        $('#editCommande').modal('hide');
                        $('#updateCommande')[0].reset();

                        location.reload();

                    } else if (res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });



        $(document).on('click', '.deleteCommandeBtn', function(e) {
            e.preventDefault();

            if (confirm('Supprimer ??')) {
                var idCommande = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "bin/codeCommande.php",
                    data: {
                        'deleteCommande': true,
                        'idCommande': idCommande
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 2) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            location.reload();
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>