<?php

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();

if(isset($_POST['saveStyle']))
{
    $name = $_POST['name'];

    if($name == NULL)
    {
        $rep = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($rep);
        return;
    }

    $sql = "INSERT INTO style (id,libelle) VALUES (NULL, :libelle)";
    $req = $conn->prepare($sql);
    $req->bindParam(':libelle',$name);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;

}


if(isset($_POST['updateStyle']))
{
    $idStyle = $_POST['idStyle'];

    $name = $_POST['name'];


    if($name == NULL)
    {
        $res = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($res);
        return;
    }

    $sql = "UPDATE style SET libelle= :libelle WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idStyle);
    $req->bindParam(':libelle',$name);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}


if(isset($_GET['idStyle']))
{
    $idStyle = $_GET['idStyle'];

    $sql = "SELECT * FROM style WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idStyle);
    $req->execute();
    if($req->rowCount() == 1)
    {
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $res = [
            'status' => 200,
            'message' => 'Style trouvé',
            'data' => $result
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Style Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['deleteStyle']))
{
    $idStyle = $_POST['idStyle'];

    $sql = "DELETE FROM style WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idStyle);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}

?>