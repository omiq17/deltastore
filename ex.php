<?php

    $password='123';
    $pass = sha1( md5($password).'raqib_hasan1993omiq' );
    echo $pass.'<br>';
     echo strlen($pass);
    
?>




<!--<select class="form-control" name="date">
                             <option disabled selected style='display:none;'>Month-Year
                                         </option>
                             <?php    
                                $months = array("January", "February", "March", "April", "May", "June","july", 
                                                "August", "September","October", "November", "December");
                                $years = array("2015", "2016", "2017");
                                $i=0; $j=0;
                                while($j<3) {
                                    $m=$i+1; $y=$j+2015;
                                    print '<option value="'.$y.'-'.$m.'" >'.$months[$i].'-'.$years[$j].'</option>';
                                    $i++;
                                    if($i==12){
                                        $i=0; $j++;
                                    }
                                }
                              ?>  
                        </select>-->