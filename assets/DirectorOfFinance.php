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
                     <h4 class="m-0 text-left">Financial Requests</h4>
                  </div>
                  
               
                     
                     <div class="col-lg-6">
                     <a href="#" class="btn btn-light" data-toggle="modal" data-target="#budgetModal"><i class="fas fa-plus-circle fa-lg">&nbsp;</i>Budget</a>
                  </div>
                        
                     
                  </div>
               </div>
               <div class="card-body">
               <div class="table-responsive" id="fetchDirectorOfFinanceIntendedRequests">
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
          <div class="table-responsive" id="fetchOfficerOfFinanceApprovedRequests">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
        </div>
      
    </div>
  </div>
         
         <!-- <div class="col-lg-12">
      <div class="card my-4 border-danger">
        <div class="card-header bg-danger text-white text-center">
          <div class="col-lg-4">
             <h4 class="m-0 text-left">Rejected Requests</h4>
           </div>
        </div>
         <div class="card-body">
          <div class="table-responsive" id="fetchFinanceOfFicerRejectedRequests">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
        </div>
      
    </div>
            
         </div> -->
</div>

<!--Request modal begin-->
<div class="modal fade" id="commentRequestModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light">Comment Request</h4>
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
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="#" method="post" id="budgetForm" class="px-3">
               <input type="hidden" name="uid" id="uid">

               
               <div class="form-group">
                  <div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
               </div>

               <div class="form-group">
                   <select name="department"  id="role" class="form-control rounded-0" required>
                <option selected value=''>select department</option>
                <option value="ict">ict</option> 
                <option value="land">land</option>
                <option value="tourism">tourism</option>
                <option value="hospitality">hospitality</option>
                <option value="nursing">nursing</option>
                <option value="optometry">optometry</option>
                
            </select>
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
<script type="text/javascript">
   $(document).ready(function(){
    //fetch Director of finance Intended Requests
      fetchDirectorOfFinanceIntendedRequests();
         function fetchDirectorOfFinanceIntendedRequests(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchDirectorOfFinanceIntendedRequests'},
               success:function(response){
                   $("#fetchDirectorOfFinanceIntendedRequests").html(response);
                   $("table").Datatable({
                     order: [0, 'desc']
                   });
               } 
            });
         }

           //fetch officer of finance rejected requests
          fetchFinanceOfFicerRejectedRequests();
         function fetchFinanceOfFicerRejectedRequests(){
           var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchFinanceOfFicerRejectedRequests'},
               success:function(response){
                   $("#fetchFinanceOfFicerRejectedRequests").html(response);
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
           
           //fetch officer of finance approved requests
         fetchOfficerOfFinanceApprovedRequests();
         function fetchOfficerOfFinanceApprovedRequests(){
            var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchOfficerOfFinanceApprovedRequests'},
               success:function(response){
                   $("#fetchOfficerOfFinanceApprovedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }

         
         //Dean approve request ajax request
         $("body").on("click",".financeApproveRequestIcon", function(e){
         e.preventDefault();

         financeId = $(this).attr('id');
       var name = "<?php echo $fullName; ?>"

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
                  data: {financeId:financeId,name:name,action:'financeAproval'},
                  success:function(response){
                     console.log(response);
                  swal.fire(
                  'Approved',
                  'Approved successfully!',
                  'success'
                  )
                     fetchDirectorOfFinanceIntendedRequests();
                      fetchFinanceOfFicerRejectedRequests();
                       fetchOfficerOfFinanceApprovedRequests();
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

         //insert budget ajax request
         $("#budgetForm").on("submit",function(){
  
             $.ajax({
                method:"post",
                 url:"php/process.php",
                 data: $("#budgetForm").serialize()+'&action=insertBudget',
 
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