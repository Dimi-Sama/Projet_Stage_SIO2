<?php

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();

if(isset($_POST['saveCouleur']))
{
    $name = $_POST['name'];
    $codeH = $_POST['couleur'];

    if($name == NULL)
    {
        $rep = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($rep);
        return;
    }

    $sql = "INSERT INTO couleur (id,libelle,codeHexa) VALUES (NULL, :libelle, :hexa)";
    $req = $conn->prepare($sql);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':hexa',$codeH);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;

}


if(isset($_POST['updateCouleur']))
{
    $idCouleur = $_POST['idCouleur'];

    $name = $_POST['name'];
    $codeH = $_POST['couleur'];     


    if($name == NULL)
    {
        $res = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($res);
        return;
    }

    $sql = "UPDATE couleur SET libelle= :libelle, codeHexa = :hexa WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCouleur);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':hexa',$codeH);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}
if(isset($_POST['updateLimite']))
{
    $idLim = $_POST['limite'];


    $sql = "UPDATE limite SET limCouleur= :limite";
    $req = $conn->prepare($sql);
    $req->bindParam(':limite',$idLim);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}

if(isset($_GET['idCouleur']))
{
    $idCouleur = $_GET['idCouleur'];

    $sql = "SELECT * FROM couleur WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCouleur);
    $req->execute();
    if($req->rowCount() == 1)
    {
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $res = [
            'status' => 200,
            'message' => 'Couleur trouvé',
            'data' => $result
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Couleur Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['deleteCouleur']))
{
    $idCouleur = $_POST['idCouleur'];

    $sql = "DELETE FROM couleur WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCouleur);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}
