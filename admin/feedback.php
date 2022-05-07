<?php
require_once 'assets/php/adminHeader.php';
?>
<h1><?=  basename($_SERVER['PHP_SELF']) ?></h1>


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