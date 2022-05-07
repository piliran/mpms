<?php
require_once 'assets/php/adminHeader.php';
?>
      <div class="row">
   	<div class="col-lg-12">
   		<div class="card my-2 border-secondary">
   			<div class="card-header bg-secondary text-white">
   				<h4 class="m-0">Total Requests of Users</h4>
   			</div>
   			<div class="card-body">
   				<div class="table-responsive" id="showAllRequests">
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

   		//fetch all requests ajax request
   		fetchAllRequests();
   		function fetchAllRequests(){
   			$.ajax({
   				url: 'assets/php/adminAction.php',
   				method: 'post',
   				data: {action: 'fetchAllRequests'},
   				success:function(response){
                   $("#showAllRequests").html(response);
                   // $("table").Datatable({
                   // 	order: [0, 'desc']
                   // })
   				} 
   			});
   		}

   		 //delete request ajax request
   		$("body").on("click",".deleteRequestIcon", function(e){
			e.preventDefault();

			requestId = $(this).attr('id');
			swal.fire({
				title: 'are you sure to delete this request?',
				
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete!'

			}).then((result)=>{
				if (result.value) {
					$.ajax({
						url: 'assets/php/adminAction.php',
						method: 'post',
						data: {requestId:requestId},
						success:function(response){
						swal.fire(
						'Deleted',
						'Request deleted successfully!',
						'success'
						)
							fetchAllRequests();
						}
					})
					
				}
			})
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