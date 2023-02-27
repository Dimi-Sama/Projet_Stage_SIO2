<?php

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();

if(isset($_POST['saveSecteur']))
{
    $name = $_POST['name'];
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

    $sql = "INSERT INTO secteuract (id,libelle,description) VALUES (NULL, :libelle,:description)";
    $req = $conn->prepare($sql);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':description',$description);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;

}


if(isset($_POST['updateSecteur']))
{
    $idSecteur = $_POST['idSecteur'];

    $name = $_POST['name'];
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

    $sql = "UPDATE secteuract SET libelle= :libelle, description = :description WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idSecteur);
    $req->bindParam(':libelle',$name);
    $req->bindParam(':description',$description);

    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}


if(isset($_GET['idSecteur']))
{
    $idSecteur = $_GET['idSecteur'];

    $sql = "SELECT * FROM secteuract WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idSecteur);
    $req->execute();
    if($req->rowCount() == 1)
    {
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $res = [
            'status' => 200,
            'message' => 'Secteur trouvé',
            'data' => $result
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Secteur Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['deleteSecteur']))
{
    $idSecteur = $_POST['idSecteur'];

    $sql = "DELETE FROM secteuract WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idSecteur);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}

?>