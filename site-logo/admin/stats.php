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

    <title>Modifier les styles de logos </title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    
</head>
<body>
<?php include 'asset/lib/navbar.php'?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Stat des styles de logos
                        
                    </h4>
                </div>
                <div class="card-body">
                <div style="height: 40vh;" id="chart-container"></div>
  <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.1/dist/echarts.min.js"></script>
<?php 

include 'bin/dbConnect.php';
                $bd = new DbConnect();
    $conn = $bd->connect();

    $sql = "SELECT libelle,nbUtilisation FROM stylelogo";
    $req = $conn->prepare($sql);
    $req->execute();
    $limite = $req->fetchALL(PDO::FETCH_ASSOC);

?>
    <script>
        var dom = document.getElementById('chart-container');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  xAxis: {
    type: 'category',
    data: [
        <?php
        
        foreach ($limite as $style) {
            $nom = $style['libelle'];
            echo " '$nom' " . "," ;
        }
        
        ?>


    ]
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [

        <?php
        
        foreach ($limite as $style) {
            $nb = $style['nbUtilisation'];
            echo " $nb " . "," ;
        }
        
        ?>
        
      ],
      type: 'bar'
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
    </script>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h4>Stat des styles
                        
                    </h4>
                </div>
                <div class="card-body">
                <div style="height: 40vh;" id="chart-containerr"></div>
  <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.1/dist/echarts.min.js"></script>
<?php 

    $conn = $bd->connect();

    $sql = "SELECT libelle,nbUtilisation FROM style";
    $req = $conn->prepare($sql);
    $req->execute();
    $limite = $req->fetchALL(PDO::FETCH_ASSOC);

?>
    <script>
        var dom = document.getElementById('chart-containerr');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  xAxis: {
    type: 'category',
    data: [
        <?php
        
        foreach ($limite as $style) {
            $nom = $style['libelle'];
            echo " '$nom' " . "," ;
        }
        
        ?>


    ]
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [

        <?php
        
        foreach ($limite as $style) {
            $nb = $style['nbUtilisation'];
            echo " $nb " . "," ;
        }
        
        ?>
        
      ],
      type: 'bar'
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
    </script>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h4>Stat des forfait
                        
                    </h4>
                </div>
                <div class="card-body">
                <div style="height: 40vh;" id="chart-containerrr"></div>
<?php 

    $conn = $bd->connect();

    $sql = "SELECT libelle,nbUtilisation FROM forfait";
    $req = $conn->prepare($sql);
    $req->execute();
    $limite = $req->fetchALL(PDO::FETCH_ASSOC);

?>
    <script>
        var dom = document.getElementById('chart-containerrr');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  xAxis: {
    type: 'category',
    data: [
        <?php
        
        foreach ($limite as $style) {
            $nom = $style['libelle'];
            echo " '$nom' " . "," ;
        }
        
        ?>


    ]
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [

        <?php
        
        foreach ($limite as $style) {
            $nb = $style['nbUtilisation'];
            echo " $nb " . "," ;
        }
        
        ?>
        
      ],
      type: 'bar'
    }
  ]
};


if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
    </script>
                </div>
</div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveStyle', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("saveStyle", true);

            $.ajax({
                type: "POST",
                url: "bin/codeStyleLogo.php",
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
                        $('#addStyle').modal('hide');
                        $('#saveStyle')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStyleBtn', function () {

            var idStyle = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "bin/codeStyleLogo.php?idStyle=" + idStyle,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#idStyle').val(res.data.id);

                        $('#editStyle').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateStyle', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updateStyle", true);

            $.ajax({
                type: "POST",
                url: "bin/codeStyleLogo.php",
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
                        
                        $('#editStyle').modal('hide');
                        $('#updateStyle')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 2) {
                        alert(res.message);
                    }
                }
            });

        });



        $(document).on('click', '.deleteStyleBtn', function (e) {
            e.preventDefault();

            if(confirm('Supprimer ??'))
            {
                var idStyle = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "bin/codeStyleLogo.php",
                    data: {
                        'deleteStyle': true,
                        'idStyle': idStyle
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