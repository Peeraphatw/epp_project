<?php
include_once "layout/header.php";
$usrtype = "ผู้ใช้งานทั่วไป";
if(isset($_REQUEST["Permision"]))
{
    $usrtype = $_REQUEST["Permision"];
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">EPP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 d-flex flex-column justify-content-center align-items-center"">
        <h3 class=" btn btn-success">สำหรับ : <?=$usrtype?></h3>
        <div class=" row">
            <div class="col-12">
                <div style="width : 80vw" id="reader" class="card bg-info p-0 m-0"></div>
                <form method="post" action="./asset.php" id="myform">
                    <input type="hidden" name="assetCode" id="assetCode">
                    <?php if(isset($_REQUEST["Permision"]) && $_REQUEST["Permision"] == "บัญชี"){?>
                    <input type="hidden" name="Permision" value="<?=$_REQUEST["Permision"]?>">
                    <?php }else if(isset($_REQUEST["Permision"]) && $_REQUEST["Permision"] == "ผู้ใช้งานทั่วไป"){ ?>
                    <input type="hidden" name="Permision" value="<?=$_REQUEST["Permision"]?>">
                    <?php }else{ ?>
                    <input type="hidden" name="Permision" value="ผู้ใช้งานทั่วไป">
                    <?php } ?>
                    <h4 class="btn btn-success mt-2" id="code">None</h4>
                    </from>
            </div>
        </div>
    </div>
    <?php include_once "layout/footer.php" ?>