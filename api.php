<?php
// header('Content-Type: application/json');

    class api extends PDO{
        public function __construct()
        {
            try
            {
                parent::__construct("sqlsrv:server=172.18.0.16 ; Database = EPPAX4_20200607", 'readonly', 'RE@d1835246()%');
                $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                //$this->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE); 
            }
            catch
            (PDOExpection $e)
            {
                echo $e->getMessage();
            }
        }
            public function getAsset($id)
            {
                $assetinfo = array();
                try{
                    // Query String Using PDO To Connect MSSQL Database 
                    // $data = $this->prepare("SELECT ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION AS Department2, Dimension2.DESCRIPTION AS Costcenter, 
                    // ASSETBOOK.EXCEEDINGNETBOOKVALUE, ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID,SUM(ASSETTRANS.AMOUNTMST) AS NETBOOKVALUE
                    //        FROM ASSETTABLE INNER JOIN
                    //                     ASSETBOOK ON ASSETTABLE.ASSETID = ASSETBOOK.ASSETID AND ASSETTABLE.DATAAREAID = ASSETBOOK.DATAAREAID INNER JOIN
                    //                     DIMENSIONS ON ASSETTABLE.DATAAREAID = DIMENSIONS.DATAAREAID AND ASSETBOOK.DIMENSION = DIMENSIONS.NUM INNER JOIN
					// 					ASSETTRANS ON ASSETTRANS.ASSETID = ASSETTABLE.ASSETID INNER JOIN
                    //                         (SELECT DESCRIPTION, NUM
                    //                           FROM  DIMENSIONS AS DIMENSIONS_1 WHERE DATAAREAID <> 'DAT' ) AS Dimension2 ON ASSETBOOK.DIMENSION2_ = Dimension2.NUM 
					// 						  WHERE ASSETTABLE.ASSETID = :id
					// 						  GROUP BY ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION, Dimension2.DESCRIPTION, 
                    // ASSETBOOK.EXCEEDINGNETBOOKVALUE, ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID");
                    $data = $this->prepare("SELECT        ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION AS Department2, Dimension2.DESCRIPTION AS Costcenter, 
                         ASSETBOOK.EXCEEDINGNETBOOKVALUE, ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID, SUM(ASSETTRANS.AMOUNTMST) AS NETBOOKVALUE
                                FROM            ASSETTABLE INNER JOIN
                                                ASSETBOOK ON ASSETTABLE.ASSETID = ASSETBOOK.ASSETID AND ASSETTABLE.DATAAREAID = ASSETBOOK.DATAAREAID LEFT OUTER JOIN
                                                ASSETTRANS ON ASSETTABLE.DATAAREAID = ASSETTRANS.DATAAREAID AND ASSETTRANS.ASSETID = ASSETTABLE.ASSETID LEFT OUTER JOIN
                                                DIMENSIONS ON ASSETBOOK.DIMENSION = DIMENSIONS.NUM AND ASSETBOOK.DATAAREAID = DIMENSIONS.DATAAREAID LEFT OUTER JOIN
                                                    (SELECT        DESCRIPTION, NUM
                                                        FROM            DIMENSIONS AS DIMENSIONS_1
                                                        WHERE        (DATAAREAID <> 'DAT')) AS Dimension2 ON ASSETBOOK.DIMENSION2_ = Dimension2.NUM
							    WHERE        (ASSETTABLE.ASSETID = :id)
								GROUP BY ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION, Dimension2.DESCRIPTION, ASSETBOOK.EXCEEDINGNETBOOKVALUE, 
                                        ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID");
                    $data->bindParam(":id",$id);
                    //BindParam To Use Where clause
                    //For Condition Add $data->bindParm(:filed,value)
                    if($data->execute())
                    {
                        return $data->fetch(PDO::FETCH_ASSOC);
                    }
                    else
                    {
                        return;
                    }
                   
                }catch(PDOExpection $e)
                {
                    return $e->getMessage();
                }
                $id = 0;
                // while($output = $data->fetch(PDO::FETCH_ASSOC))
                // {
                //     $assetinfo[$id] = array(
                //         'ASSETID' => $output['ASSETID'],
                //         'NAME' => $output['NAME'],
                //         'Department' => $output['Department2'],
                //         'Costcenter' =>  $output['Costcenter'],
                //         'EXCEEDINGNETBOOKVALUE' => $output['EXCEEDINGNETBOOKVALUE'],
                //         'ACQUISITIONDATE' => $output['ACQUISITIONDATE'],
                //         'PURCHID' => $output['PURCHID']
                //     );
                //     $id++;
                // }
                // $data = null;
                //return json_encode($assetinfo);
                // return $assetinfo;
            }
            
            
            public function getAssetReg($id)
            {
                $assetinfo = array();
                try{
                    // Query String Using PDO To Connect MSSQL Database 
                    $data = $this->prepare("SELECT ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION AS Department2, Dimension2.DESCRIPTION AS Costcenter, 
                                                          ASSETBOOK.EXCEEDINGNETBOOKVALUE, ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID
                                                FROM   ASSETTABLE INNER JOIN
                                                            ASSETBOOK ON ASSETTABLE.ASSETID = ASSETBOOK.ASSETID AND ASSETTABLE.DATAAREAID = ASSETBOOK.DATAAREAID LEFT OUTER JOIN
                                                                DIMENSIONS ON ASSETBOOK.DIMENSION = DIMENSIONS.NUM AND ASSETBOOK.DATAAREAID = DIMENSIONS.DATAAREAID LEFT OUTER JOIN
                                                                    (SELECT        DESCRIPTION, NUM
                                                                            FROM            DIMENSIONS AS DIMENSIONS_1
                                                                            WHERE        (DATAAREAID <> 'DAT')) AS Dimension2 ON ASSETBOOK.DIMENSION2_ = Dimension2.NUM
							                    WHERE        (ASSETTABLE.ASSETID = :id)
									            GROUP BY ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION, Dimension2.DESCRIPTION, ASSETBOOK.EXCEEDINGNETBOOKVALUE, 
                                                            ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID");
                    $data->bindParam(":id",$id);
                    //BindParam To Use Where clause
                    //For Condition Add $data->bindParm(:filed,value)
                    if($data->execute())
                    {
                        return $data->fetch(PDO::FETCH_ASSOC);
                    }
                    else
                    {
                        return;
                    }
                   
                }catch(PDOExpection $e)
                {
                    return $e->getMessage();
                }
                $id = 0;
                
            }

            public function auth($empid){
                    $assetinfo = array();
                try{
                    // Query String Using PDO To Connect MSSQL Database 
                    $data = $this->prepare("SELECT ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION AS Department2, Dimension2.DESCRIPTION AS Costcenter, 
                    ASSETBOOK.EXCEEDINGNETBOOKVALUE, ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID
                           FROM ASSETTABLE INNER JOIN
                                        ASSETBOOK ON ASSETTABLE.ASSETID = ASSETBOOK.ASSETID AND ASSETTABLE.DATAAREAID = ASSETBOOK.DATAAREAID INNER JOIN
                                        DIMENSIONS ON ASSETTABLE.DATAAREAID = DIMENSIONS.DATAAREAID AND ASSETBOOK.DIMENSION = DIMENSIONS.NUM INNER JOIN
                                            (SELECT DESCRIPTION, NUM
                                              FROM  DIMENSIONS AS DIMENSIONS_1 WHERE DATAAREAID <> 'DAT' ) AS Dimension2 ON ASSETBOOK.DIMENSION2_ = Dimension2.NUM WHERE ASSETTABLE.ASSETID = :id");
                    $data->bindParam(":id",$id);
                    //BindParam To Use Where clause
                    //For Condition Add $data->bindParm(:filed,value)
                    if($data->execute())
                    {
                        return $data->fetch(PDO::FETCH_ASSOC);
                    }
                    else
                    {
                        return;
                    }
                   
                }catch(PDOExpection $e)
                {
                    return $e->getMessage();
                }
            }
    }

    // $API = new api;
    // print_r($API->getAsset("5-08-009-1294"));

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //    if(!isset($_POST['id']))
    //    {
    //        return;
    //    }
    //     echo $API->getAsset($_POST['id']);
    // }else
    // {
    //     echo $_SERVER['REQUEST_METHOD'] ."METHOD NOT ALLOWED";
    // }