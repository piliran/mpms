<?php 
   require_once 'php/header.php';
   if (!isset($_SESSION['user'])) {
   	header('location: index.php');
   }
   
 ?>

   <div class="container">
   	<div class="row justify-content-center my-2">
   		<div class="col-lg-6 mt-4" id="showAllNotification">
   			
   		</div>
   	</div>
   </div>

<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){


		//fetch notification of a user
		fetchNotification();
		function fetchNotification(){
			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {action : 'fetchNotification'},
				success:function(response){
					$("#showAllNotification").html(response);
				}
			})
		}

		//view resource request of a user ajax request
		$("body").on("click",".infoBtn",function(e){
			e.preventDefault();

			infoId= $(this).attr('id');

			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {infoId:infoId},
				success:function(response){
					data = JSON.parse(response);
					swal.fire({
						// title: '<strong>Request</strong>',
						type: 'info',
						html: '<b>Request: </b>'+data.itemName+'<br><br><b>Sent On: </b>'+data.createdAt,
						showCloseButton: true,
					})

				}
			});
		})

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

		//remove notification
		$("body").on("click",".close", function(e){
			e.preventDefault();

			notificationId = $(this).attr('id');

			$.ajax({
				url: 'php/process.php',
				method: 'post',
				data: {notificationId : notificationId},
				success:function(response){
					checkNotification();
					fetchNotification();
				}
			})
		})
	})
</script>
</body>
</html>