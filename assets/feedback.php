<?php 
   require_once 'php/header.php';
   if (!isset($_SESSION['user'])) {
   	header('location: index.php');
   }
   
 ?>
<div class="container">
	<div class="card border-success mt-4">
		<h5 class="card-header bg-success text-center">
					<p class="font-weght-bold text-light">FEEDBACK</p>
		</h5>
		<div class="card-body">
			<div class="table-responsive" id="showFeedback">
				
						
					
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

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
			});
		}

	

		 displayAllFeedback();
		//display all fedback of a user ajax request
		function displayAllFeedback(){
			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {action: 'displayAllFeedback'},
				success:function(response){
					 $("#showFeedback").html(response);
					// $("table").DataTable({
					// 	order: [0, 'desc']

					// });

				}
			});
		}

		//delete feedback of a user
		$("body").on("click",".deleteFeedbackIcon", function(e){
			e.preventDefault();

			deleteFeedbackId = $(this).attr('id');
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
						data: {deleteFeedbackId:deleteFeedbackId},
						success:function(response){
						swal.fire(
						'Deleted',
						'Request deleted successfully!',
						'success'
						)
							displayAllFeedback();
						}
					})
					
				}
			})
		});
	});
</script>
</body>
</html>