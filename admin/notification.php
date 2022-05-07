<?php
require_once 'assets/php/adminHeader.php';
?>

     <div class="row justify-content-center my-2">
     	<div class="col-lg-6 mt-4" id="showNotification">
     		
     	</div>
     </div>

      <!--footer area-->
   		</div>
   	</div>
   </div>

   <script type="text/javascript">
   	$(document).ready(function(){

   		//fetch notification ajax request
   		fetchNotification();
   		function fetchNotification(){
   			$.ajax({
   				url: 'assets/php/adminAction.php',
   				method: 'post',
   				data: {action : 'fetchNotification'},
   				success:function(response){
   					$("#showNotification").html(response);
   			}
   		})
   	}

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

    //remove notification ajax request
    $("body").on("click",".close", function(e){
      e.preventDefault();

      notificationID = $(this).attr('id');

      $.ajax({
        url: 'assets/php/adminAction.php',
        method: 'post',
        data: {notificationID:notificationID},
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