<?php

        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'http://localhost/Hackathon/still_good/public/produits',

                            ));

                            $resp = curl_exec($curl);

                            curl_close($curl);

                            $produit= json_decode($resp);

        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_URL => 'http://localhost/Hackathon/still_good/public/magasins',

                        ));

                        $resp = curl_exec($curl);

                        curl_close($curl);

                        $magasins= json_decode($resp);


        //$produit= json_decode($resp);
                            //print_r($produit);
                            //echo ($produit[0]->nom);


                             foreach ($produit as $produit){
                                echo '<table>';
                                echo '<tr>';
                                echo '<td>'.$produit->nom.'</td>';
                                echo "<td>".$magasins[$produit->id_magasin]->nom."</td>";
                                echo "<td>".$produit->date_peremption."</td>";
                                echo  "</tr>";
                                echo '</table>';
                            };
?>



