<?php 
   require_once 'php/header.php';

 
?>
<div class="container-fluid">
		<div class="row">
   	<div class="col-lg-12">

   	</div>
   </div>
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
               <div class="table-responsive" id="fetchDeanIntendedRequests">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
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
          <div class="table-responsive" id="fetchDeanApprovedRequests">
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
          <div class="table-responsive" id="fetchDeanrejectedRequests">
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
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
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
    //fetch Dean Intended Requests
      fetchDeanIntendedRequests();
         function fetchDeanIntendedRequests(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchDeanIntendedRequests'},
               success:function(response){
                   $("#fetchDeanIntendedRequests").html(response);
                   $("table").Datatable({
                     order: [0, 'desc']
                   });
               } 
            });
         }

          //fetch dean rejected requests
          fetchDeanrejectedRequests();
         function fetchDeanrejectedRequests(){
           var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchDeanrejectedRequests'},
               success:function(response){
                   $("#fetchDeanrejectedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }
           
           //fetch dean approved requests
         fetchDeanApprovedRequests();
         function fetchDeanApprovedRequests(){
             var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchDeanApprovedRequests'},
               success:function(response){
                   $("#fetchDeanApprovedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }
         
         //Dean approve request ajax request
         $("body").on("click",".ApproveRequestIcon", function(e){
         e.preventDefault();

           var name = "<?php echo $fullName; ?>"
          var role = "<?php echo $userRole; ?>"
         deanApprovedId = $(this).attr('id');
        
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
                  data: {deanApprovedId:deanApprovedId,name:name,role:role,action:'deanApproveRequest'},
                  success:function(response){
                     console.log(response);
                  swal.fire(
                  'Approved',
                  'Approved successfully!',
                  'success'
                  )
                     fetchDeanIntendedRequests();
                     fetchDeanrejectedRequests();
                       fetchDeanApprovedRequests();
                  }
               });
               
            }
         });
      });


         //get user user ID ajax requst
        $("body").on("click", ".DeanCommentRequestIcon", function(e){
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
         

         //dean comment ajax request
         $("#commentRequestBtn").click(function(e){
         if ($("#commentForm")[0].checkValidity()) {
            e.preventDefault();

            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: $("#commentForm").serialize()+'&action=DeanCommentRequest',
               success:function(response){
                 $("#commentForm")[0].reset();
                  $("#commentRequestModal").modal('hide');
                  swal.fire({
                     title: 'Request commented successfully',
                     type: 'success',
                  showCloseButton: true
                  });
                  
                  fetchDeanIntendedRequests();
               }
            });

         }
      });

   });

</script>

</body>
</html>