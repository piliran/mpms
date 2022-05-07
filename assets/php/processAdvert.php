<?php
require_once 'auth.php';
 $userObject = new Auth();
//handle advert ajax request
   if(isset($_POST['action']) && $_POST['action'] =='fetchAdvertData') {
    
     $output = '';
    $advert = $userObject->fetchAdvert();
   

    if ($advert) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  
                  <th>Resources</th>
                  
                 
                 
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($advert as $row) {
                   
                    $output .='<tr>
                               
                               
                               <td>'.$row['itemName'].'</td>
                               
                               
                               

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new advert available!</h3>';
    }
  }

  ?>