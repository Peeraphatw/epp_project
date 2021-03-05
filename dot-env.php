<?php
    $stmt_ac = "SELECT ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION AS Department2, Dimension2.DESCRIPTION AS Costcenter, 
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
                         ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID";

                         
    $stmt_reg = "SELECT ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION AS Department2, Dimension2.DESCRIPTION AS Costcenter, 
                                                          ASSETBOOK.EXCEEDINGNETBOOKVALUE, ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID
                                                FROM   ASSETTABLE INNER JOIN
                                                            ASSETBOOK ON ASSETTABLE.ASSETID = ASSETBOOK.ASSETID AND ASSETTABLE.DATAAREAID = ASSETBOOK.DATAAREAID LEFT OUTER JOIN
                                                                DIMENSIONS ON ASSETBOOK.DIMENSION = DIMENSIONS.NUM AND ASSETBOOK.DATAAREAID = DIMENSIONS.DATAAREAID LEFT OUTER JOIN
                                                                    (SELECT        DESCRIPTION, NUM
                                                                            FROM            DIMENSIONS AS DIMENSIONS_1
                                                                            WHERE        (DATAAREAID <> 'DAT')) AS Dimension2 ON ASSETBOOK.DIMENSION2_ = Dimension2.NUM
							                    WHERE        (ASSETTABLE.ASSETID = :id)
									            GROUP BY ASSETTABLE.ASSETID, ASSETTABLE.NAME, ASSETBOOK.DIMENSION, ASSETBOOK.DIMENSION2_, DIMENSIONS.DESCRIPTION, Dimension2.DESCRIPTION, ASSETBOOK.EXCEEDINGNETBOOKVALUE, 
                                                            ASSETBOOK.ACQUISITIONDATE, ASSETBOOK.DIMENSION3_, ASSETBOOK.PURCHID"";