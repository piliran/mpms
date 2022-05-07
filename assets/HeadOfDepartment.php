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
                     <h4 class="m-0 text-left">Total Departmental Requests of Users</h4>
                     </div>

                     

                   <div class="col-lg-6 text-right text-light">
                    <div class="row">
                      <div>
                        <h4 >BALANCE&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp; MWK&nbsp;</h4>
                      </div>
                      <div>
                         <h4 class="text-left" id="showBalance"></h4>
                      </div>
                    </div>
                      
                   </div>
               </div>
   			</div>

        <div class="col-lg-12">
      
        
         <div class="card-body">
          <div class="table-responsive" id="fetchAllDepartmentalRequests">
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
          <div class="table-responsive" id="fetchHODApprovedRequests">
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
          <div class="table-responsive" id="fetchHODrejectedRequests">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
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

<!--Budget modal begin-->
<div class="modal fade" id="budgetModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-secondary">
            <h4 class="modal-title text-light">Insert Budget</h4>
            <button type="button" class="close text-light" data-didmiss="modal">&nbsp;</button>
         </div>
         <div class="modal-body">
            <form action="#" method="post" id="budgetForm" class="px-3">
               <input type="hidden" name="uid" id="uid">

               
               <div class="form-group">
                  <div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
               </div>
                     
                           <div class="form-group">
                  <input type="number" name="budget" id="budget" class="form-control form-control-lg" placeholder="Budget" required> 
               </div>
               
               
               <div class="form-group">
                  <input type="submit" name="budgetForm" id="budgetBtn" value="Submit" class="btn btn-secondary btn-block btn-lg"> 
               </div>
            </form>
         </div>
      </div>
   </div>
</div> 
<!--Budget modal end--> 

<!--Request modal begin-->
<div class="modal fade" id="addRequestModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h4 class="modal-title text-light"> Request</h4>
        <button type="button" class="close text-light" data-didmiss="modal">&nbsp;</button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="addRequestForm" class="px-3">
          <div class="form-group">
            <div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
          </div>

          <div class="form-group">
            <textarea name="request" id="request"  class="form-control form-control-lg" placeholder="Enter request"></textarea> 
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
      fetchAllDepartmentalRequests();
         function fetchAllDepartmentalRequests(){
            var department = "<?php echo $userDepartment; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {department: department},
               success:function(response){
                   $("#fetchAllDepartmentalRequests").html(response);
                   $("table").DataTable({
                    order: [0, 'desc']

                     });
               } 
            });
         }
         
         //fetch hod rejected requests
          fetchHODrejectedRequests();
         function fetchHODrejectedRequests(){
            var departmentRejected = "<?php echo $userDepartment; ?>"
            var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {departmentRejected: departmentRejected,name:name,action:'fetchHODrejectedRequests'},
               success:function(response){
                   $("#fetchHODrejectedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }
           
           //fetch hod approved requests
         fetchHODApprovedRequests();
         function fetchHODApprovedRequests(){
            var departmentApproved = "<?php echo $userDepartment; ?>"
            var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {departmentApproved: departmentApproved,name:name,action:'fetchHODApprovedRequests'},
               success:function(response){
              
                   $("#fetchHODApprovedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }
         
         //HOD approve request ajax request
         $("body").on("click",".ApproveRequestIcon", function(e){
         e.preventDefault();
         
         var name = "<?php echo $fullName; ?>"
          var role = "<?php echo $userRole; ?>"
         approvedId = $(this).attr('id');
         

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
                  data: {approvedId:approvedId,name:name,role:role,action:'departmentalApproval'},
                  success:function(response){
                     console.log(response);
                  swal.fire(
                  'Approved',
                  'Approved successfully!',
                  'success'
                  )
                     fetchAllDepartmentalRequests();
                      fetchHODApprovedRequests();
                       fetchHODrejectedRequests();
                  }
               });
               
            }
         });
      });
       
       //get user user ID ajax requst
        $("body").on("click", ".HODcommentRequestIcon", function(e){
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
         

         //departmental comment ajax request
         $("#commentRequestBtn").click(function(e){
         if ($("#commentForm")[0].checkValidity()) {
            e.preventDefault();

            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: $("#commentForm").serialize()+'&action=commentRequest',
               success:function(response){
                 $("#commentForm")[0].reset();
                  $("#commentRequestModal").modal('hide');
                  swal.fire({
                     title: 'Request commented successfully',
                     type: 'success',
                  showCloseButton: true
                  });
                  
                  fetchAllDepartmentalRequests();
               }
            });

         }
      });
         
         //insert budget ajax request
         $("#budgetForm").on("submit",function(){
   var budget=$("#budget").val();
   var department = "<?php echo $userDepartment; ?>"
   $.ajax({
  method:"post",
  data:{budget:budget,department:department,action:"insertBudget"},
  url:"php/process.php",
  success:function(response){
   
    $("#budgetForm")[0].reset();
                  $("#budgetModal").modal('hide');
                  swal.fire({
                     title: 'Budget inserted successfully',
                     type: 'success',
                  showCloseButton: true
                  });
  }
   });
return false;

      });

         //check department balance ajax request
         checkBalance();
         function checkBalance(){
            var departmentBalance = "<?php echo $userDepartment; ?>"
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {departmentBalance: departmentBalance},
               success:function(response){
                   
                   data = JSON.parse(response);
                    $("#showBalance").html(data.budget);
                    
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
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

   });
 
</script>
  
</body>
</html>