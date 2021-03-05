<?php 
ini_set('display_errors', 'On');
include_once 'api.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EPP Asset QR Code Scanner</title>
    <link rel="shortcut icon" href="/asset/EPP.jpg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    * {
        font-family: 'Roboto', sans-serif;
    }
    </style>
</head>

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
    <?php 
    if(!isset($_POST['assetCode']) || !isset($_POST['Permision']))
    {
            //echo '<script>location.replace("https://asset.eppcup.com/")</script>'; 
            echo "<script>location.replace('https://asset.eppcup.com/";

            if(isset($_POST['Permision'])){echo  "?Permision=".$_POST['Permision'];}
            
            echo "')</script>"; 
            exit();
            echo 'False';;
    }else
    {
        $api = new api; 
        $res = $api->getAsset($_POST['assetCode']);
        if($_POST['Permision'] == 'บัญชี')  
        {
            $res = $api->getAsset($_POST['assetCode']);
            $api = null;
        }else
        {
            $_POST['Permision'] = 'ผู้ใช้งานทั่วไป';
            $res = $api->getAssetReg($_POST['assetCode']);
            $api = null;
        }
        
        if($res['ASSETID'] == '')
        {
            echo "<script>alert('Not Found Asset   ".$_POST['assetCode']."')</script>"; 
            echo "<script>location.replace('https://asset.eppcup.com/";

            if(isset($_POST['Permision'])){echo  "?Permision=".$_POST['Permision'];}
            
            echo "')</script>"; 
            exit();
            echo 'False';
        }
    }
    ?>
    <div class="container mt-5 user-select-none">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header text-uppercase bg-primary text-white">
                        Asset Detail
                    </div>
                    <div class="card-body">
                        <!-- src="172.18.0.100/~path" -->
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <img class="img-thumbnail"
                                src="https://media.istockphoto.com/photos/super-computer-server-racks-in-datacenter-3d-illustration-picture-id918951042?k=6&m=918951042&s=612x612&w=0&h=xnXeXjlBxo1hoegS1RzqSdzqwP-axE50_UpORStKEGw="
                                alt="" />
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสทรัพย์สิน</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3" value="<?=$res['ASSETID']?>"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อทรัพย์สิน</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3" value="<?=$res['NAME']?>"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">แผนก</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3"
                                    value="<?=$res['Department2']?>" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Location</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3" value="<?=$res['Costcenter']?>"
                                    readonly />
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">มูลค่าคงเหลือทรัพย์สิน</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3"
                                    value="<res['EXCEEDINGNETBOOKVALUE']>" readonly>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Date</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3"
                                    value="<?=date_format(date_create(substr($res['ACQUISITIONDATE'],0,10)),"d/m/Y")?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสคำสั่งซื้อ</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3" value="<?=$res['PURCHID']?>"
                                    readonly />
                            </div>
                        </div>
                        <?php if($_POST['Permision'] === 'บัญชี') {?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Value models</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputEmail3"
                                    value="<?=number_format($res['NETBOOKVALUE'])?> บาท" readonly />
                            </div>
                        </div>
                        <?php  } ?>
                    </div>
                    <div class="card-footer bg-primary text-white">Peeraphatw</div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <a href="/<?php if(isset($_POST['Permision'])){echo  "?Permision=".$_POST['Permision'];}?>"
                        class="btn btn-success btn-lg shadow-lg mt-5">Scanner</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>