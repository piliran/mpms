<?php
 require_once 'php/session.php';
?>
<!DOCTYPE html>
<html>
<head>
   <?php 
      $title = basename($_SERVER['PHP_SELF'],'.php');
    ?>
   <title><?= ucfirst($title); ?> | Procurement Officer panel</title>
   <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
   <link rel="stylesheet" type="text/css" href="../sweetAlert/sweetalert2.min.css">
  <script type="text/javascript" src="../sweetAlert/sweetalert2.all.min.js"></script>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
   <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
   <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
   <script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function(){
         $("#openNav").click(function(){
            $(".procure-nav").toggleClass('animate');
         })
      })
   </script>
   <style type="text/css">
      .procure-nav{
         width: 220px;
         min-height: 100vh;
         overflow: hidden;
         background-color: #343a60;
         transition: 0.3s all ease-in-out;
      }
      .procure-link{
         background-color: #343a60;
      }
      .procure-link:hover, .nav-active{
         background-color: #212529;
         text-decoration: none;
      }
      .animate{
         width: 0;
         transition: 0.3s all ease-in-out;
      }
   </style>
</head>
<body>
   <div class="container-fluid">
      <div class="row">
         <div class="procure-nav p-0">
            <h4 class="text-light text-center p-2">Procurement Officer Panel</h4>

            <div class="list-group list-group-flush">
               <a href="Dashboard.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='Dashboard.php')?"nav-active " :" " ?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp; Dashboard</a>

               <a href="Suppliers.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='procureSuppliers.php')?"nav-active":"" ?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp; Suppliers</a>

               <a href="requests.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='requests.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Requests</a>

               <a href="resources.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='recources.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Resources</a>

               <a href="advertise.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='advertise.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Advertise</a>

               <a href="procureFeedback.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='procureFeedback.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Feedback</a>

               <a href="generateReceipt.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='generateReceipt.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Receipt</a>

               <a href="procureNotification.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='procureNotification.php')?"nav-active":"" ?>"><i class="fas fa-bell"></i>&nbsp;&nbsp; Notification&nbsp;<span id="checkNotification"></span></a>

               <a href="messages.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='messages.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Messages&nbsp;<span id="checkNotification"></span></a>
             </div>
         </div>
         <div class="col">
            <div class="row">
               <div class="col-lg-12 bg-success pt-2 justify-content-between d-flex">
                  <a href="#" class="text-light" id="openNav"><h3><i class="fas fa-bars"></i></h3></a>

                  <h4 class="text-light"><?= $title ?></h4>

                  <a href="php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
               </div>
            </div>


         <div class="container-fluid">
      
      <div class="card my-4 border-secondary">
            <div class="card-header bg-secondary text-white text-center">
               <div class="row">
                  <div class="col-lg-6">
                     <h4 class="m-0 text-left">Requests From All Departments</h4>
                  </div>
                  
                  <div class="col-lg-6">
                     
                  <!-- <a href="#" class="text-light text-right"><h4>Advertise</h4></a> -->
                        
                     </div>
                  </div>
               </div>
               <div class="card-body">
               <div class="table-responsive" id="fetchProcurementOfficerIntendedRequests">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
               </div>
            </div>
            </div>

            <div class="col-lg-12">
      <div class="card my-4 border-success">
        <div class="card-header bg-success text-white text-center">
          <div class="row">
            <div class="col-lg-4">
             <h4 class="m-0 text-left">Approved Requests</h4>
           </div>
            <div class="col-lg-4">
             
           </div>
           <div class="col-lg-4">
             <a href="#" class="btn btn-light" data-toggle="modal" data-target="#generateReportModal">PDF</a>
           </div>
          </div>
          
        </div>
       <div class="card-body">
          <div class="table-responsive" id="fetchProcurementOfficerApprovedRequests">
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
          <div class="table-responsive" id="fetchProcurementOfficerRejectedRequests">
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
                     
                          <!--  <div class="form-group">
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

 <!--Report modal begin-->
<div class="modal fade" id="generateReportModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-secondary">
            <h4 class="modal-title text-light">Generate Report</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
             <form action="processApprovedRequestsReport.php" method="post" id="fullReportForm" class="px-3">
               
              <input type="hidden" name="fullName" value="<?= $fullName; ?>">

               <div class="form-group">
                  <input type="submit" name="fullReportForm" id="ReportFormBtn" value="generate" class="btn btn-secondary btn-block btn-lg"> 
               </div>
            </form> 
         </div>
      </div>
   </div>
</div>

<!--Report modal end-->
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
    //comment request ajax request
      fetchProcurementOfficerIntendedRequests();
         function fetchProcurementOfficerIntendedRequests(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchProcurementOfficerIntendedRequests'},
               success:function(response){
                   $("#fetchProcurementOfficerIntendedRequests").html(response);
                   $("table").Datatable({
                     order: [0, 'desc']
                   })
               } 
            });
         }

           //fetch procurement approved requests
          fetchProcurementOfficerRejectedRequests();
         function fetchProcurementOfficerRejectedRequests(){
           var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchProcurementOfficerRejectedRequests'},
               success:function(response){
                   $("#fetchProcurementOfficerRejectedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }
           
           //fetch procurement approved requests
         fetchProcurementOfficerApprovedRequests();
         function fetchProcurementOfficerApprovedRequests(){
            var name = "<?php echo $fullName; ?>"
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {name:name,action: 'fetchProcurementOfficerApprovedRequests'},
               success:function(response){
                   $("#fetchProcurementOfficerApprovedRequests").html(response);
                   // $("table").DataTable({
                   //  order: [0, 'desc']

                   //   });
               } 
            });
         }

         
         
         // procurement officer approve request ajax request
         $("body").on("click",".ApproveRequestIcon", function(e){
         e.preventDefault();

       
           var name = "<?php echo $fullName; ?>"
            var role = "<?php echo $userRole; ?>"
              procureApprovedId = $(this).attr('id');

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
                  data: {procureApprovedId:procureApprovedId,name:name,role:role,action:'procurementApproval'},
                  success:function(response){
                     console.log(response);
                  swal.fire(
                  'Approved',
                  'Approved successfully!',
                  'success'
                  )
                     fetchProcurementOfficerIntendedRequests();
                       fetchProcurementOfficerRejectedRequests();
                        fetchProcurementOfficerApprovedRequests();
                  }
               });
               
            }
         });
      });


       
         

        

   });

</script>
</body>
</body>
</html>