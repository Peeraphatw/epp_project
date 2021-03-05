<?php
    header("Content-Type: application/json; charset=UTF-8");)
    $pdo = new POD("sqlsrv:server=172.18.0.16 ; Database = EPPAX4_20200607", 'readonly', 'RE@d1835246()%');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["empid"]))
    {
    $pdo->prepare('SELECT * FROM');
    $pdo->bindparam(:empid,$_POST['empid']);
    $pdo->exec();
     echo TRUE;
    }else
    {
        echo FALSE;
    }

   echo json_encode(true);
   echo "<h1>curl</h1>"
   