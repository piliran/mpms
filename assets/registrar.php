<?php 
   require_once 'php/header.php';
   
 ?>

<div class="container-fluid">
		<div class="row">
   	<div class="col-lg-12">
   		<div class="card my-4 border-secondary">
   			<div class="card-header bg-secondary text-white text-center">
               <div class="row">
                  <div class="col-lg-6">
                     <h4 class="m-0 text-left">Requests From All Departments</h4>
                  </div>
                  
                  <div class="col-lg-6">
                     
                  
                        
                     </div>
                  </div>
               </div>
               <div class="card-body">
               <div class="table-responsive" id="fetchRegistrarIntendedRequests">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
               </div>
            </div>
   			</div>
   			
   		</div>
   	</div>

       <div class="col-lg-12">
      <div class="card my-4 border-success">
        <div class="card-header bg-success text-white text-center">
          <div class="col-lg-4">
             <h4 class="m-0 text-left">Approved Requests</h4>
           </div>
        </div>
       <div class="card-body">
          <div class="table-responsive" id="fetchRegistrarApprovedRequests">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
        </div>
      
    </div>
  </div>
         
         <div class="col-lg-12">
      <div class="card my-4 border-danger">
        <div class="card-header bg-danger text-white text-center">
          <div class="col-lg-4">
             <h4 class="m-0 text-left">Rejected Requests</h4>
           </div>
        </div>
         <div class="card-body">
          <div class="table-responsive" id="fetchRegistrarRejectedRequests">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
        </div>
      
    </div>
  </div>
   </div>


<!--Request modal begin-->
<div class="modal fade" id="commentRequestModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light">Reject Request</h4>
				<button type="button" class="close text-light" data-didmiss="modal">&nbsp;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="commentForm" class="px-3">
               <input type="hidden" name="uid" id="uid">
               <input type="hidden" name="id" id="id">
               <input type="hidden" name="role" value="<?= $userRole; ?>">
               <input type="hidden" name="fullName" value="<?= $fullName; ?>">
					<div class="form-group">
						<div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
					</div>
                     
              					<!-- <div class="form-group">
						<input type="text" name="title"  class="form-control form-control-lg" placeholder="Title" required> 
					</div> -->
					
					<div class="form-group">
						  <textarea name="message" rows="10" cols="30"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="commentForm" id="commentRequestBtn" value="Submit" class="btn btn-secondary btn-block btn-lg"> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--Request modal end-->  
<script type="text/javascript">
   $(document).ready(function(){
    //comment request ajax request
      fetchRegistrarIntendedRequests();
         function fetchRegistrarIntendedRequests(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchRegistrarIntendedRequests'},
               success:function(response){
                   $("#fetchRegistrarIntendedRequests").html(response);
                   $("table").Datatable({
                     order: [0, 'desc']
                   })
               } 
            });
         }

         //fetch registrar rejected requests
          fetchRegistrarRejectedRequests();
         function fetchRegistrarRejectedRequests(){
           var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchRegistrarRejectedRequests'},
               success:function(response){
                   $("#fetchRegistrarRejectedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }
           
           //fetch registrar approved requests
         fetchRegistrarApprovedRequests();
         function fetchRegistrarApprovedRequests(){
            var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchRegistrarApprovedRequests'},
               success:function(response){
                   $("#fetchRegistrarApprovedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
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
      });
    }
         
         //registrar approve request ajax request
         $("body").on("click",".ApproveRequestIcon", function(e){
         e.preventDefault();
         var name = "<?php echo $fullName; ?>"
         var role = "<?php echo $userRole; ?>"
         registrarApprovedId = $(this).attr('id');

         swal.fire({
            title: 'are you sure you want to approve this request?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve!'

         }).then((result)=>{
            
            if (result.value) {
               $.ajax({
                  url: 'php/process.php',
                  type: 'post',
                  data: {registrarApprovedId:registrarApprovedId,name:name,role:role,action:'registrarApproveRequest'},
                  success:function(response){
                     console.log(response);
                  swal.fire(
                  'Approved',
                  'Approved successfully!',
                  'success'
                  )
                     fetchRegistrarIntendedRequests();
                      fetchRegistrarRejectedRequests();
                       fetchRegistrarApprovedRequests();
                  }
               });
               
            }
         });
      });


         //get user user ID ajax requst
        $("body").on("click", ".RegistrarCommentRequestIcon", function(e){
         e.preventDefault();

         userId = $(this).attr('id');
      
         
         $.ajax({
            url: 'php/process.php',
            method: 'post',
            data: {userId: userId},
            success:function(response){
               data = JSON.parse(response);
               $("#id").val(data.id);
               $("#uid").val(data.uid);
               
            }
         });
      });
         

         //registrar comment ajax request
         $("#commentRequestBtn").click(function(e){
         if ($("#commentForm")[0].checkValidity()) {
            e.preventDefault();
              

            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: $("#commentForm").serialize()+'&action=registrarCommentRequest',
               success:function(response){
                 $("#commentForm")[0].reset();
                  $("#commentRequestModal").modal('hide');
                  swal.fire({
                     title: 'Request commented successfully',
                     type: 'success',
                  showCloseButton: true
                  });
                  
                  fetchRegistrarIntendedRequests();
               }
            });

         }
      });

   });

</script>

</body>
</html>


