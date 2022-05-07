

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
 
  <link rel="stylesheet" type="text/css" href="../sweetAlert/sweetalert2.min.css">
  <script type="text/javascript" src="../sweetAlert/sweetalert2.all.min.js"></script>
 
  <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
</head>

<body>

<!--div>
	<h2 style="text-align: center; "><i>Advert</i></h2>
	
</div-->
<div class="container-fluid">
		<div class="row">
   	<div class="col-lg-12">

   	</div>
   </div>
   <div class="card my-4 border-secondary">
            <div class="card-header bg-secondary text-light text-center">
               <div class="row">
                  <div class="col-lg-12">
                     <h4 class="m-0 text-center">ADVERT</h4>
                  </div>
                  
                
                  </div>
               </div>
               <div class="card-body">
               <div class="table-responsive" id="fetchAdvert">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
               </div>
            </div>
            </div>
            
         </div>

  <script type="text/javascript">
  	$(document).ready(function(){

  		//fetch advert data  ajax request
  		 

     fetchAdvert();
         function fetchAdvert(){
            
            $.ajax({
               url: 'php/processAdvert.php',
               method: 'post',
               data: {action: 'fetchAdvertData'},
               success:function(response){
                
                   $("#fetchAdvert").html(response);
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
               } 
            });
         }
  	});
  </script>





  <div class="input-group input-group-lg form-group " >
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-phone fa-sm"></i>
              </span>
            </div>
             +265-992-331-463
           </div>
  

</body>
</html>