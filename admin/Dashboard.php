<?php
require_once 'assets/php/adminHeader.php';
require_once 'assets/php/adminDb.php';

$count = new Admin();
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card-deck mt-3 text-light text-center font-weight-bold">

			<div class="card bg-secondary">
				<div class="card-header">
					Total Users
				</div>
				<div class="card-body">
					<h1 class="display-4">
						<?= $count->totalCount('users');  ?>
					</h1>
				</div>
			</div>

			<div class="card bg-success">
				<div class="card-header">
					Verified Users
				</div>
				<div class="card-body">
					<h1 class="display-4">
						<?= $count->verifiedUsers(1);  ?>
					</h1>
				</div>
			</div>

			<div class="card bg-secondary">
				<div class="card-header">
					Unverified Users
				</div>
				<div class="card-body">
					<h1 class="display-4">
						<?= $count->verifiedUsers(0);  ?>
					</h1>
				</div>
			</div>


		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card-deck mt-3 text-light text-center font-weight-bold">
			<div class="card bg-success">
				<div class="card-header">
					Total Requests
				</div>
				<div class="card-body">
					<h1 class="display-4">
						<?= $count->totalCount('request');  ?>
					</h1>
				</div>
			</div>

			<div class="card bg-secondary">
				<div class="card-header">
					Total Notifications
				</div>
				<div class="card-body">
					<h1 class="display-4">
						<?= $count->totalCount('notifications');  ?>
					</h1>
				</div>
			</div>

			<div class="card bg-success">
				<div class="card-header">
					Total Feedback
				</div>
				<div class="card-body">
					<h1 class="display-4">
						<?= $count->totalCount('feedback');  ?>
					</h1>
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
   	})
   </script>
</body>
</html>