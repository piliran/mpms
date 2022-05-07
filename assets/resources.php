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

               <a href="Suppliers.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='Suppliers.php')?"nav-active":"" ?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp; Suppliers</a>

               <a href="requests.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='requests.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Requests</a>

               <a href="resources.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='resources.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Resources</a>

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
            <div class="card my-2 border-secondary">
            <div class="card-header bg-secondary text-white text-center">
               <div class="row">
                  <div class="col-lg-12">
                     <h4 class="m-0 text-left">Resources from suppliers</h4>
                  </div>
                  
                  
                  </div>
               </div>
               <div class="card-body">
               <div class="table-responsive" id="fetchAllResources">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
               </div>
            </div>
            </div>

            <div class="col-lg-12">
      <div class="card my-4 border-success">
        <div class="card-header bg-success text-white text-center">
          <div class="col-lg-4">
             <h4 class="m-0 text-left">Bought resources</h4>
           </div>
        </div>
       <div class="card-body">
          <div class="table-responsive" id="fetchAllBoughtResources">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
        </div>
      
    </div>
  </div>

  <div class="col-lg-12">
      <div class="card my-4 border-danger">
        <div class="card-header bg-danger text-white text-center">
          <div class="col-lg-4">
             <h4 class="m-0 text-left">Rejected resources</h4>
           </div>
        </div>
       <div class="card-body">
          <div class="table-responsive" id="fetchRejectedResources">
            <p class="text-center align-self-center lead">Please Wait..</p>
            
          </div>
        </div>
      
    </div>
  </div>
         </div>
         </div>

         <!--Request modal begin-->
<div class="modal fade" id="contactSupplierModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-secondary">
            <h4 class="modal-title text-light">Approve Supply</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="#" method="post" id="contactForm" class="px-3">
               <div id="messageResponse"></div>
               <input type="hidden" name="id" id="id">
              <input type="hidden" name="uid" id="uid">
               <input type="hidden" name="role" value="<?= $userRole; ?>">
                <input type="hidden" name="fullName" value="<?= $fullName; ?>">
               <div class="form-group">
                  <div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
               </div>
                     
                           
               
               <div class="form-group">
                    <textarea name="message" rows="5" cols="55"></textarea>
               </div>
               <div class="form-group">
                  <input type="submit" name="contactForm" id="contactBtn" value="Send" class="btn btn-secondary btn-block btn-lg"> 
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!--Request modal end-->

<!--Reject resource modal begin-->
<div class="modal fade" id="rejectResourceModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-secondary">
            <h4 class="modal-title text-light">Reject Supply</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="#" method="post" id="rejectResourceForm" class="px-3">
               <div id="messageResponse"></div>
               <input type="hidden" name="Id" id="Id">
              <input type="hidden" name="Uid" id="Uid">
               <input type="hidden" name="role" value="<?= $userRole; ?>">
                <input type="hidden" name="fullName" value="<?= $fullName; ?>">
               <div class="form-group">
                  <div id="addSuccessful" class="text-success text-center font-weght-bold"></div>
               </div>
                     
                           
               
               <div class="form-group">
                    <textarea name="Message" rows="5" cols="55"></textarea>
               </div>
               <div class="form-group">
                  <input type="submit" name="rejectResourceForm" id="rejectResourceBtn" value="Send" class="btn btn-secondary btn-block btn-lg"> 
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!--Reject resource modal end-->
      </div>
   </div>

   <script type="text/javascript">
   $(document).ready(function(){
   

         fetchAllResources();
         function fetchAllResources(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchAllResources'},
               success:function(response){
                   $("#fetchAllResources").html(response);
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
               } 
            });
         }
       
       //fetch bought resources ajax request
         fetchAllBoughtResources();
         function fetchAllBoughtResources(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchAllBoughtResources'},
               success:function(response){
                   $("#fetchAllBoughtResources").html(response);
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
               } 
            });
         }

          //fetch rejected resources ajax request
         fetchRejectedResources();
         function fetchRejectedResources(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchRejectedResources'},
               success:function(response){
                   $("#fetchRejectedResources").html(response);
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
               } 
            });
         }

   
         $("body").on("click", ".contactSupplierIcon", function(e){
         e.preventDefault();

         supplierId = $(this).attr('id');
          
                  
         $.ajax({
            url: 'php/process.php',
            method: 'post',
             data: {supplierId:supplierId},
            success:function(response){
               console.log(response)
               data = JSON.parse(response);
               
              $("#id").val(data.id);
              $("#uid").val(data.uid);
            }
         });
      });
         
         //send approve resource message ajax request
          $("#contactBtn").click(function(e){
         if ($("#contactForm")[0].checkValidity()) {
            e.preventDefault();

            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: $("#contactForm").serialize()+'&action=sendApproveMessage',
               success:function(response){
                  $("#messageResponse").html(response);
                 $("#contactForm")[0].reset();

            $("#contactSupplierModal").modal('hide');
                  // $("#contactSupplierModal").modal('hide');
                 
                  // swal.fire({
                  //    title: 'Message sent successfully',
                  //    type: 'success',
                  // showCloseButton: true
                  // });
                  
                  fetchAllResources();
                  fetchAllBoughtResources();
                    fetchRejectedResources();
               }
            });

         }
      });

           $("body").on("click", ".procureRejectIcon", function(e){
         e.preventDefault();

         rejectResourceId = $(this).attr('id');
         

                  
         $.ajax({
            url: 'php/process.php',
            method: 'post',
             data: {rejectResourceId:rejectResourceId},
            success:function(response){
             
               data = JSON.parse(response);
                console.log(data);
              $("#Id").val(data.id);
              $("#Uid").val(data.uid);
            }
         });
      });

            //send reject message to supplier ajax request
          $("#rejectResourceBtn").click(function(e){
         if ($("#rejectResourceForm")[0].checkValidity()) {
            e.preventDefault();

            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: $("#rejectResourceForm").serialize()+'&action=sendRejectMessage',
               success:function(response){
                console.log(response);

                  $("#messageResponse").html(response);
                 $("#rejectResourceForm")[0].reset();
                 $("#rejectResourceModal").modal('hide');
                  // $("#contactSupplierModal").modal('hide');
                 
                  // swal.fire({
                  //    title: 'Message sent successfully',
                  //    type: 'success',
                  // showCloseButton: true
                  // });
                  
                  fetchAllResources();
                  fetchAllBoughtResources();
                    fetchRejectedResources();

               }
            });

         }
      });

        //Dean approve request ajax request
        /* $("body").on("click",".procureRejectIcon", function(e){
         e.preventDefault();

         rejectResourceId = $(this).attr('id');

         swal.fire({
            title: 'are you sure you want to reject this resource?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject!'

         }).then((result)=>{
            
            if (result.value) {
               $.ajax({
                  url: 'php/process.php',
                  type: 'post',
                  data: {rejectResourceId:rejectResourceId},
                  success:function(response){
                     console.log(response);
                  swal.fire(
                  'Rejected',
                  'Rejected successfully!',
                  'success'
                  )
                     fetchAllResources();
                  }
               });
               
            }
         });
      });*/
        

   });

</script>

</body>
</html>