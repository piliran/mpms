<?php 
   require_once 'php/header.php';
    if (!isset($_SESSION['user'])) {
   	header('location: index.php');
   }
   
 ?> 

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php if($verified == 'Not Verified'): ?>
			<div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
				<button class="close" type="button" data-dismiss="alert">&times;</button>
				<strong>Your E-mail is not verified! we have sent you an E-mail link on your E-mail, check and verify now!</strong>
			</div>
		<?php endif; ?>
		<h4 class="text-center text-dark mt-2">Request the resources you need here</h4>
		</div>
	</div>
	<div class="card border-success">
		<h5 class="card-header bg-success  d-flex justify-content-between">
					<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addRequestModal"><i class="fas fa-plus-circle fa-lg">&nbsp;</i>Request Resource</a>
		</h5>
		<div class="card-body">
			<div class="table-responsive" id="showRequest">
				
									
			</div>
		</div>
	</div>
	
</div>

<!--Request modal begin-->
<div class="modal fade" id="addRequestModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light">Add new Request</h4>
				<button type="button" class="close text-light" data-didmiss="modal">&nbsp;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="addRequestForm" class="px-3">
					<div class="form-group">
						<div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
					</div>

					<div class="form-group">
						<textarea name="itemName"  class="form-control form-control-lg" placeholder="Enter request"></textarea> 
					</div>
                     
              			
					<div class="form-group">
						<input type="submit" name="addRequest" id="addRequestBtn" value="Add Request" class="btn btn-secondary btn-block btn-lg" placeholder="Enter Item Name" required> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Request modal end-->

<!--Edit Request modal begin-->
<div class="modal fade" id="editRequestModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light">Edit Request</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&nbsp;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="editRequestForm" class="px-3">
					<div class="form-group">
						<div id="editSuccessful" class="text-success text-center font-weght-bold"></div>
					</div>
					
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<textarea name="itemName" id="itemName" class="form-control form-control-lg" placeholder="Enter Request" required ></textarea> 
					</div>
					<!-- <div class="form-group">
						<input type="number" name="itemQuantity" id="itemQuantity" class="form-control form-control-lg" placeholder="Enter Item Quantity" required> 
					</div>
					<div class="form-group">
						<input type="text" name="itemQuality" id="itemQuality" class="form-control form-control-lg" placeholder="Enter Item Cost" required> 
					</div> -->
					<div class="form-group">
						<input type="submit" name="editRequest" id="editRequestBtn" value="Update Request" class="btn btn-secondary btn-block btn-lg" placeholder="Enter Item Name" required> 
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
		$("#addRequestBtn").click(function(e){
			if ($("#addRequestForm")[0].checkValidity()) {
				e.preventDefault();

				$("#addRequestBtn").val('Please Wait..');

				$.ajax({
					url: 'php/process.php',
					method: 'post',
					data: $("#addRequestForm").serialize()+'&action=addrequest',
					success:function(response){
					$("#addRequestBtn").val('Add Request');
						
						// swal.fire({
						// 	title: 'Request added successfully',
						// 	type: 'success'
						// });
                        $("#addSuccessful").html('Resource added Successfully!');
                        $("#addRequestForm")[0].reset();
						$("#addRequestModal").modal('hide');
						displayAllrequests();
					}
				});
  
			}
		});

		//edit resource request of a user ajax request
		$("body").on("click", ".editBtn", function(e){
			e.preventDefault();

			editId = $(this).attr('id');
			//console.log(editId);
			
			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {editId: editId},
				success:function(response){
					data = JSON.parse(response);
					$("#id").val(data.id);
					$("#itemName").val(data.itemName);
					$("#itemQuantity").val(data.itemQuantity);
					$("#itemQuality").val(data.itemQuality);
				}
			});
		});

		//update resource request of a user
		$("#editRequestBtn").click(function(e){
			if ($("#editRequestForm")[0].checkValidity()) {
				e.preventDefault();

				$.ajax({
					url: 'php/process.php',
					method: 'post',
					data: $("#editRequestForm").serialize()+'&action=updateRequest',
					success:function(response){
						$("#editRequestForm")[0].reset();
						$("#editRequestModal").modal('hide');
						swal.fire({
							title: 'Request updated successfully',
							type: 'success',
						showCloseButton: true
						});
						
						displayAllrequests();
					}
				});

			}
		});

		//delete resource request of a user
		$("body").on("click",".deleteBtn", function(e){
			e.preventDefault();

			deleteId = $(this).attr('id');
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
						data: {deleteId:deleteId},
						success:function(response){
						swal.fire(
						'Deleted',
						'Request deleted successfully!',
						'success'
						)
							displayAllrequests();
						}
					})
					
				}
			})
		});

		//view resource request of a user ajax request
		$("body").on("click",".infoBtn",function(e){
			e.preventDefault();

			infoId = $(this).attr('id');

			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {infoId:infoId},
				success:function(response){
					data = JSON.parse(response);
					swal.fire({
						title: '<strong>Request : ID('+data.id+')</strong>',
						type: 'info',
						html: '<b>Request: </b>'+data.itemName+'<br><br><b>Sent On: </b>'+data.createdAt,
						showCloseButton: true,
					})

				}
			});
		})


        displayAllrequests();
		//display all resource requests of a user ajax request
		function displayAllrequests(){
			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {action: 'displayRequests'},
				success:function(response){
					 $("#showRequest").html(response);
					$("table").DataTable({
						order: [0, 'desc']

					});

				}
			});
		}

		//check notification
		checkNotification();
		function checkNotification(){
			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {action : 'checkNotification'},
				success:function(response){
					$("#checkNotification").html(response);
				}
			})
		}

		
	});
  </script>
</body>
</html>