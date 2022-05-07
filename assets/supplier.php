 <?php 
   require_once 'php/session.php';
    if (!isset($_SESSION['user'])) {
   	header('location: index.php');
   }
   
 ?>

<!DOCTYPE html>
<html>
<head>
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="../sweetAlert/sweetalert2.min.css">
  <script type="text/javascript" src="../sweetAlert/sweetalert2.all.min.js"></script>
 <script type="text/javascript" src="../datatable/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../datatable/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-success navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand  <?= (basename($_SERVER['PHP_SELF']) == "supplier.php")? "active": ""; ?>" href="supplier.php"><i class="fas fa-home fa-lg"></i>&nbsp;Home</a>

  <!--  -->

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "supplierProfile.php")? "active": ""; ?>" href="supplierProfile.php"><i class="fas fa-user-circle fa-lg"></i>&nbsp;Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "supplierFeedback.php")? "active": ""; ?>" href="supplierFeedback.php"><i class="fas fa-comment-dots fa-lg"></i>&nbsp;Feedback</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "supplierNotification.php")? "active": ""; ?>" href="supplierNotification.php"><i class="fas fa-bell fa-lg"></i>&nbsp;Notification&nbsp;<span id="checkNotification"></span></a>
      </li>
      <li class="nav-item">
        <a href="php/logout.php" class="nav-link text-light mt-1"><i class="fas fa-sign-out-alt fa-lg"></i>&nbsp;Logout</a>
      </li>
    

    </ul>
  </div>
</nav> 


  

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php if($verified == 'Not Verified'): ?>
			<div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
				<button class="close" type="button" data-dismiss="alert">&times;</button>
				<strong>Your E-mail is not verified! we have sent you an E-mail link on your E-mail, check and verify now!</strong>
			</div>
		<?php endif; ?>
		<h4 class="text-center text-dark mt-2">Send your Resources here!</h4>
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
               <div class="table-responsive" id="fetchAdvertData">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
               </div>
            </div>
            </div>


	<div class="card border-success">
		<h5 class="card-header bg-success text-light d-flex justify-content-between">
			
					<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addResourceModal"><i class="fas fa-plus-circle fa-lg">&nbsp;</i>Fill Bid</a>
		</h5>
		<div class="card-body">
			<div class="table-responsive" id="showResources">
				
						
					
			</div>
		</div>
	</div>

	
</div>

<!--Request modal begin-->
<div class="modal fade" id="addResourceModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light">Add new Resource</h4>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="addResourceForm" class="px-3">
					<div class="form-group">
						<div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
					</div>
                     <input type="hidden" name="department" id="department">
              		<div class="form-group">
						<textarea name="itemName" id="itemName" class="form-control form-control-lg" placeholder="Enter Resource"></textarea> 
					</div>
					<!-- <div class="form-group">
						<input type="number" name="itemQuantity" class="form-control form-control-lg" placeholder="Enter Item Quantity" required> 
					</div>
					<div class="form-group">
						<input type="text" name="itemQuality" class="form-control form-control-lg" placeholder="Enter Item Quality" required> 
					</div> -->
					<div class="form-group">
						<input type="number" name="itemCost" class="form-control form-control-lg" placeholder="Enter Resource Cost" required> 
					</div>
					<div class="form-group">
						<input type="submit" name="addResource" id="addResourceBtn" value="Add Resource" class="btn btn-secondary btn-block btn-lg"> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Request modal end-->

<!--Edit Request modal begin-->
<div class="modal fade" id="editResourceModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light">Edit Resource</h4>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="editResourceForm" class="px-3">
					<div class="form-group">
						<div id="editSuccessful" class="text-success text-center font-weght-bold"></div>
					</div>
					
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<textarea name="itemName"  class="form-control form-control-lg" placeholder="Enter Resource"></textarea> 
					</div>
					<!-- <div class="form-group">
						<input type="number" name="itemQuantity" id="itemQuantity" class="form-control form-control-lg" placeholder="Enter Item Quantity" required> 
					</div>
					<div class="form-group">
						<input type="text" name="itemQuality" id="itemQuality" class="form-control form-control-lg" placeholder="Enter Item Quality" required> 
					</div> -->
					<div class="form-group">
						<input type="number" name="itemCost" id="itemCost" class="form-control form-control-lg" placeholder="Enter Item Cost" required> 
					</div>
					<div class="form-group">
						<input type="submit" name="editResource" id="editResourceBtn" value="Update Resource" class="btn btn-secondary btn-block btn-lg"> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Edit Request modal end-->



<script type="text/javascript">
	$(document).ready(function(){
		

		//add new resource ajax request
		$("#addResourceBtn").click(function(e){
			if ($("#addResourceForm")[0].checkValidity()) {
				e.preventDefault();

				$("#addResourceBtn").val('Please Wait..');

				$.ajax({
					url: 'php/process.php',
					method: 'post',
					data: $("#addResourceForm").serialize()+'&action=addResource',
					success:function(response){
					$("#addResourceBtn").val('Add Resource');
						
						// swal.fire({
						// 	title: 'Request added successfully',
						// 	type: 'success'
						// });
                        $("#addSuccessful").html('Resource added Successfully!');
                        $("#addResourceForm")[0].reset();
						$("#addResourceModal").modal('hide');
						displayAllResources();
					}
				});
  
			}
		});

		

		//delete resource request of a user
		$("body").on("click",".deleteBtn", function(e){
			e.preventDefault();

			deleteResourceId = $(this).attr('id');
			swal.fire({
				title: 'are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'

			}).then((result)=>{
				if (result.value) {
					$.ajax({
						url: 'php/process.php',
						method: 'post',
						data: {deleteResourceId:deleteResourceId},
						success:function(response){
						swal.fire(
						'Deleted',
						'Resource deleted successfully!',
						'success'
						)
							displayAllResources();
						}
					})
					
				}
			})
		});

	     displayAllResources();
		//display all resource requests of a user ajax request
		function displayAllResources(){
			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {action: 'displayResource'},
				success:function(response){
					 $("#showResources").html(response);
					$("table").DataTable({
						order: [0, 'desc']

					});

				}
			});
		}


		$("body").on("click", ".supplyIcon", function(e){
         e.preventDefault();

         supplyId = $(this).attr('id');

                  
         $.ajax({
            url: 'php/process.php',
            method: 'post',
             data: {supplyId:supplyId},
            success:function(response){
               console.log(response)
               data = JSON.parse(response);
               
              $("#itemName").val(data.itemName);
              $("#department").val(data.department);
            }
         });
      });

		//check supplier notification
    checkNotification();
    function checkNotification(){
      $.ajax({
        url: 'php/process.php',
        method: 'post',
        data: {action : 'checkSupplierNotification'},
        success:function(response){
          $("#checkNotification").html(response);
        }
      })
    }

	//fetch advert data  ajax request
     fetchAdvert();
         function fetchAdvert(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchAdvert'},
               success:function(response){
                
                   $("#fetchAdvertData").html(response);
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
               } 
            });
         }

		
	});
  </script>
</body>
</html>





