<?php
require_once 'assets/php/adminHeader.php';
?>
   
   <div class="row">
   	<div class="col-lg-12">
   		<div class="card my-2 border-success">
   			<div class="card-header bg-success text-white">
          <div class="row">

            <div class="col-lg-6">
            <h4 class="m-0">Total Registered Users</h4>
          </div>
          <div class="col-lg-6 text-right" >
             <a href="#" class="btn btn-light align-self-right getPassword" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-plus-circle fa-lg">&nbsp;</i>Add User</a>
          </div>
          </div>
          
          
   			</div>
   			<div class="card-body">
   				<div class="table-responsive" id="showAllUsers">
   					<p class="text-center align-self-center lead">Please Wait..</p>
   				</div>
   			</div>
   		</div>
   	</div>
   </div>

<!--display user's in details modal-->
<div class="modal fade" id="showUserDetailModal">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="getName"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="card-deck">
					<div class="card border-primary">
						<div class="card-body">
			
							<p id="getEmail"></p>
							<p id="getPhone"></p>
							<p id="getGender"></p>
							<p id="getRole"></p>
							<p id="getCreatedAt"></p>
							<p id="getVerified"></p>
						</div>
					</div>
					<div class="card align-self-center" id="getImage"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Button to Open the Modal -->

<!-- The Modal -->
<div class="modal" id="addUserModal">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <!--h4 class="modal-title"></h4-->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="container-fluid">
         <form action="#" method="POST" class="px-3" id="register-form">
            <div id="regAlert"></div>
            <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="far fa-user fa-lg"></i>
              </span>
            </div>
          <select name="role"  id="role" class="form-control rounded-0" required onchange="checkRole()">
                <option selected value=''>select role</option>
                <option value="viceChancellor">vice chancellor</option>
                <option value="registrar">registrar</option>
                <option value="dean">dean</option>
                <option value="departmentalHead">departmental head</option>
                <option value="procurementOfficer">procurement officer</option>
                <option value="supplier">supplier</option>
                <option value="student">student</option>
                <option value="financeDirector">finance director</option>
            </select>
           </div>

           <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="far fa-user fa-lg"></i>
              </span>
            </div>
          <select name="gender"  id="gender" class="form-control rounded-0" required>
                <option value='' selected>Select gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
            </select>
           </div>
             <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="far fa-user fa-lg"></i>
              </span>
            </div>
             <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>
           </div>
           <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="far fa-envelope fa-lg"></i>
              </span>
            </div>
             <input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-Mail" required>
           </div>

           <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-phone fa-lg"></i>
              </span>
            </div>
             <input type="tel" name="phone" id="phone" class="form-control rounded-0" placeholder="Phone" required>
           </div>

           <div class="input-group input-group-lg form-group" id="departmentDiv" style="display: none">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-home fa-lg"></i>
              </span>
            </div>
             <input type="text" name="department" id="department" class="form-control rounded-0" placeholder="Department">
           </div>

                      
           <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-key fa-lg"></i>
              </span>
            </div>
             <input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Password" required minlength="5">
           </div>
            <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-key fa-lg"></i>
              </span>
            </div>
             <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required minlength="5">
           </div>
           <input type="checkbox" onclick="myFunction()">Show Password
           <div class="form-group">
            <div id="passErr" class="text-danger font-weght-bold"></div>
           </div>
           
           <div class="form-group">
            <input type="submit" value="Sign Up" id="register-btn" class="btn btn-success btn-lg btn-block myBtn">
           </div>
         </form>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- footer area -->
   		</div>
   	</div>
   </div>
   <script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("rpassword");
       var y = document.getElementById("cpassword");
      if (x.type ==="password") {
        x.type = "text";
      }
      else{
        x.type = "password";
      }
      if (y.type ==="password") {
        y.type = "text";
      }
      else{
        y.type = "password";
      }
    }
    function checkRole(){
      $("#role").val() === "student" || $("#role").val() === "departmentalHead"? $("#departmentDiv").show(): $("#departmentDiv").hide()
    }
   	$(document).ready(function(){
        
   		//fetch all users ajax request
   		fetchAllUsers();
   		function fetchAllUsers(){
   			$.ajax({
   				url: 'assets/php/adminAction.php',
   				method: 'post',
   				data: {action: 'fetchAllUsers'},
   				success:function(response){
                   $("#showAllUsers").html(response);
                   $("table").DataTable({
                    order: [0, 'desc']

                    });
   				} 
   			});
   		}

   		//display user in details ajax request
   		$("body").on("click", ".userDetailsIcon", function(e){
   			e.preventDefault();

   			detailsId = $(this).attr('id');
   			$.ajax({
   				url: 'assets/php/adminAction.php',
   				type: 'post',
   				data: {detailsId:detailsId},
   				success:function(response){
   					data = JSON.parse(response);
                    $("#getName").text(data.name);
                    $("#getEmail").text('Email : '+data.email);
                    $("#getPhone").text('Phone : '+data.phone);
                    $("#getGender").text('Gender : '+data.gender);
                    $("#getRole").text('Role : '+data.role);
                    $("#getCreatedAt").text('Joined On : '+data.createdAt);
                    $("#getVerified").text('Verified : '+data.verified);

                    if (data.photo != '') {
                    	$("#getImage").html('<img src="../assets/php/'+data.photo+'" class="img-thumbnail img-fluid align-self-center" width="280px">');
                    }
                    else{
                    	$("#getImage").html('<img src="../assets/php/pja.png" class="img-thumbnail img-fluid align-self-center" width="280px">');
                    }
   				}
   			})

   		})
       //get user password
       $("body").on("click",".getPassword",function(e){
        e.preventDefault();

        $.ajax({
          url: 'assets/php/adminAction.php',
          method: 'post',
          data:{action:'getPassword'},
          success:function(response){
              console.log(response);
              $("#rpassword").val(response);
              $("#cpassword").val(response);
          }
        })
       })
        
        //deactivate user ajax request
   		$("body").on("click",".deleteUserIcon", function(e){
			e.preventDefault();

			deleteId = $(this).attr('id');
			swal.fire({
				title: 'are you sure?',
				
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, deactivate!'

			}).then((result)=>{
				if (result.value) {
					$.ajax({
						url: 'assets/php/adminAction.php',
						method: 'post',
						data: {deleteId:deleteId},
						success:function(response){
						swal.fire(
						'Deactivated',
						'User deactivated successfully!',
						'success'
						)
							fetchAllUsers();
						}
					})
					
				}
			})
		});

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

    //register ajax request
  $("#register-btn").click(function(e){
        if($("#register-form")[0].checkValidity()){
          e.preventDefault();
          $("#register-btn").val("Please wait...");
          if($("#rpassword").val() != $("#cpassword").val()){
            $("#passErr").text("* Password did not match");
            $("#register-btn").val("Sign Up");
          }
          else{
            
            $("#passErr").text("");
            $.ajax({
                  url: 'assets/php/adminAction.php',
                  method: 'post',
                  data: $("#register-form").serialize()+'&action=register',
                  success: function(response){
                    
                   $("#register-btn").val("Sign Up");
                   if (response=='successful') {
                    $("#register-form")[0].reset();
                  $("#addUserModal").modal('hide');
                  swal.fire({
                     title: 'Registration successful',
                     type: 'success',
                  showCloseButton: true
                  });
                  
                     //$("#regAlert").html('registration successful');
                   }
                   else{
                      $("#regAlert").html(response);
                   }
                  
                  }
            });
          }
        }
  });
   	});
   </script>
</body>
</html>