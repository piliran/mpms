<?php
require_once 'assets/php/adminHeader.php';
?>
 <div class="row">
   	<div class="col-lg-12">
   		<div class="card my-2 border-danger">
   			<div class="card-header bg-danger text-white">
   				<h4 class="m-0">Total Diactivated Users</h4>
   			</div>
   			<div class="card-body">
   				<div class="table-responsive" id="showAllDeletedUsers">
   					<p class="text-center align-self-center lead">Please Wait..</p>
   				</div>
   			</div>
   		</div>
   	</div>
   </div>

<!--footer area-->
   		</div>
   	</div>
   </div>
   <script type="text/javascript">
   	$(document).ready(function(){

   		//fetch all deleted users ajax request
   		fetchAllDeletedUsers();
   		function fetchAllDeletedUsers(){
   			$.ajax({
   				url: 'assets/php/adminAction.php',
   				method: 'post',
   				data: {action: 'fetchAllDeletedUsers'},
   				success:function(response){
                   $("#showAllDeletedUsers").html(response);
                   // $("table").Datatable({
                   // 	order: [0, 'desc']
                   // })
   				} 
   			});
   		}

   		//Restore user ajax request
			$("body").on("click",".RestoreUserIcon", function(e){
			e.preventDefault();

			RestoreID = $(this).attr('id');

			swal.fire({
				title: 'are you sure you want to activate this user?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, activate!'

			}).then((result)=>{
				
				if (result.value) {
					$.ajax({
						url: 'assets/php/adminAction.php',
						type: 'post',
						data: {RestoreId:RestoreID},
						success:function(response){
							console.log(response);
						swal.fire(
						'Activated',
						'Activated successfully!',
						'success'
						)
							fetchAllDeletedUsers();
						}
					});
					
				}
			});
		});

       //check notification
    checkNotification();
    function checkNotification(){
      $.ajax({
        url: 'assets/php/adminAction.php',
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