<?php

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();

if(isset($_POST['saveStyle']))
{
    $name = $_POST['name'];
    $description = $_POST['desc'];	
    $imgName = $_FILES["image"]["name"];
    $repImg = '../../../asset/imgLogo/';
    if($name == NULL && $imgName == NULL && $description == NULL)
    {
        $rep = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($rep);
        return;
    }

    $sql = "INSERT INTO styleLogo (id,libelle,description,img) VALUES (NULL, :libelle, :description, :img)";
    $req = $conn->prepare($sql);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':description',$description);
    $req->bindParam(':img',$imgName);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
        move_uploaded_file($_FILES['image']['tmp_name'], $repImg . $imgName);
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
    $description = $_POST['desc'];	
    $imgName = $_FILES["image"]["name"];
    $repImg = '../../../asset/imgLogo/';


    if($name == NULL)
    {
        $res = [
            'status' => 0,
            'message' => 'Champ invalide'
        ];
        echo json_encode($res);
        return;
    }

    $sql = "UPDATE styleLogo SET libelle= :libelle , description = :description, img = :img WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idStyle);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':description',$description);
    $req->bindParam(':img',$imgName);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
        move_uploaded_file($_FILES['image']['tmp_name'], $repImg . $imgName);
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}


if(isset($_GET['idStyle']))
{
    $idStyle = $_GET['idStyle'];

    $sql = "SELECT * FROM styleLogo WHERE id= :id";
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
            'message' => ' Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['deleteStyle']))
{
    $Style = $_POST['idStyle'];
    $split = explode('/', $Style);
    $repImg = '../../../asset/imgLogo/';

    $sql = "DELETE FROM styleLogo WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$split[0]);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
        unlink($repImg.$split[1]);
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}

?>