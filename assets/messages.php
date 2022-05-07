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

               <a href="resources.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='recources.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Resources</a>

               <a href="advertise.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='advertise.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Advertise</a>

               <a href="procureFeedback.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='procureFeedback.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Feedback</a>

               <a href="generateInvoice.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='generateInvoice.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Receipt</a>

               <a href="procureNotification.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='procureNotification.php')?"nav-active":"" ?>"><i class="fas fa-bell"></i>&nbsp;&nbsp; Notification&nbsp;<span id="checkNotification"></span></a>

               <a href="messages.php" class="list-group-item text-light procure-link <?= (basename($_SERVER['PHP_SELF'])=='messages.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Messages&nbsp;<span id="checkNotification"></span></a>
               
            </div>
         </div>
         <div class="col">
            <div class="row">
               <div class="col-lg-12 bg-success pt-2 justify-content-between d-flex">
                  <a href="#" class="text-light" id="openNav"><h3><i class="fas fa-bars"></i></h3></a>

                  <h4 class="text-light"><?= $title ?></h4>

                  <a href="assets/php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
               </div>
            </div>
             <div class="container">
            <div class="card my-2 border-success">
            
               <div class="card-body">
               <div id="fetchMessages">
                  <p class="text-center align-self-center lead">Please Wait..</p>
                  
               </div>
            </div>
            </div>
         </div>
         </div>

         
      </div>
   </div>
   <script type="text/javascript">
   $(document).ready(function(){
   

         fetchMessages();
         function fetchMessages(){
            
            $.ajax({
               url: 'php/process.php',
               method: 'post',
               data: {action: 'fetchMessages'},
               success:function(response){
                   $("#fetchMessages").html(response);
                   // $("table").Datatable({
                   //   order: [0, 'desc']
                   // })
               } 
            });
         }

           //deactivate user ajax request
         $("body").on("click",".close", function(e){
         e.preventDefault();

         deleteMessageID = $(this).attr('id');
         swal.fire({
            title: 'are you sure you want to delete this message?',
            
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete!'

         }).then((result)=>{
            if (result.value) {
               $.ajax({
                  url: 'php/process.php',
                  method: 'post',
                  data: {deleteMessageID:deleteMessageID},
                  success:function(response){
                  swal.fire(
                  'Deleted',
                  'Message deleted successfully!',
                  'success'
                  )
                     fetchAllUsers();
                  }
               })
               
            }
         })
      });
        

   });

</script>
</body>
</html>