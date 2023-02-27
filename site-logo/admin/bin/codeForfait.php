<?php

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();

if(isset($_POST['saveForfait']))
{
    $name = $_POST['name'];
    $prix = $_POST['prix'];
    $description = $_POST['desc'];	

    if($name == NULL && $description == NULL)
    {
        $rep = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($rep);
        return;
    }

    $sql = "INSERT INTO forfait (id,libelle,description, prix) VALUES (NULL, :libelle,:description, :prix)";
    $req = $conn->prepare($sql);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':description',$description);
    $req->bindParam(':prix',$prix);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;

}


if(isset($_POST['updateForfait']))
{
    $idForfait = $_POST['idForfait'];

    $name = $_POST['name'];
    $prix = $_POST['prix'];
    $description = $_POST['desc'];	
    


    if($name == NULL && $description == NULL)
    {
        $res = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($res);
        return;
    }

    $sql = "UPDATE forfait SET libelle= :libelle,description = :description, prix = :prix WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idForfait);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':description',$description);
    $req->bindParam(':prix',$prix);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}


if(isset($_GET['idForfait']))
{
    $idForfait = $_GET['idForfait'];

    $sql = "SELECT * FROM forfait WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idForfait);
    $req->execute();
    if($req->rowCount() == 1)
    {
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $res = [
            'status' => 200,
            'message' => 'Forfait trouvé',
            'data' => $result
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => ' Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['deleteForfait']))
{
    $idForfait = $_POST['idForfait'];

    $sql = "DELETE FROM forfait WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idForfait);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}

?>