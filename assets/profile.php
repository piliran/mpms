<?php 
   require_once 'php/header.php';
  if (!isset($_SESSION['user'])) {
   	header('location: index.php');
   }
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10">
			<div class="card rounded-0 mt-3 border-success">
				<div class="card-header border-success">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
						</li>

						<li class="nav-item">
							<a href="#editProfile" class="nav-link  font-weight-bold" data-toggle="tab">Edit Profile</a>
						</li>

						<!--li class="nav-item">
							<a href="#changePass" class="nav-link  font-weight-bold" data-toggle="tab">Change password</a>
						</li-->
					</ul>
				</div>
				<div class="card-body">
					<div class="tab-content">

<!--profile tab content tab start
 -->						<div class="tab-pane container active" id="profile">
							<div class="card-deck">
								<div class="card border-success">
									<!--div class="card-header bg-success text-light text-center lead">
										User ID: <?= $userId; ?>
									</div-->
									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #4caf50;"><b>Name : </b><?= $fullName  ?></p>
									</div>
									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #4caf50;"><b>E-mail : </b><?= $userEmail  ?></p>
									</div>
									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #4caf50;"><b>Phone : </b><?= $userPhone; ?></p>
									</div>
									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #4caf50;"><b>Role : </b><?= $userRole;  ?></p>
									</div>

									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #4caf50;"><b>Gender : </b><?= $userGender;  ?></p>
									</div>

									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #4caf50;"><b>Department : </b><?= $userDepartment;  ?></p>
									</div>

								</div>
								<div class="card border-success align-self-center">
									<?php if(!$userPhoto): ?>
										<img src="php/pja.png" class="img-thumbnail img-fluid" width="408px">
										<?php else: ?>
											<img src="<?= 'php/'.$userPhoto; ?>" class="img-thumbnail img-fluid" width="400px">
										<?php endif; ?>
								</div>
							</div>
						</div>
						<!--profile tab content tab end-->

						<!--Edit profile tab content tab start-->
						<div class="tab-pane container fade" id="editProfile">
							<div class="card-deck">
								<div class="card border-info align-self-center">
									<?php if(!$userPhoto): ?>
										<img src="php/pja.png" class="img-thumbnail img-fluid" width="408px">
										<?php else: ?>
											<img src="<?= 'php/'.$userPhoto; ?>" class="img-thumbnail img-fluid" width="408px">
										<?php endif; ?>
								</div>
								<div class="card border-info">
									<form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="ProfileUpdateForm">
										<input type="hidden" name="oldImage" value="<?= $userPhoto; ?>">
										<div class="form-group m-0">
											<label for="profilePhoto" class="m-1">Upload profile image</label>
											<input type="file" name="image" id="profilePhoto">
										</div>
										<div class="form-group m-0">
											<label for="name" class="m-1">Name</label>
											<input type="text" name="name" id="name" class="form-control" value="<?= $fullName; ?>">
										</div>
										<div class="form-group m-0">
											<label for="gender" class="m-1">Gender</label>
											<select name="gender" id="gender" class="form-control">
												<option value="" disabled <?php if ($userGender==null) {
													echo "Selected";
												} ?>>Select</option>
												<option value="Male" <?php if ($userGender=='Male') {
													echo "Selected";
												} ?>>Male</option>
												<option value="Female" <?php if ($userGender=='Female') {
													echo "Selected";
												} ?>>Female</option>
											</select>
     										</div>

     										<div class="form-group m-0">
											<label for="phone" class="m-1">Phone</label>
											<input type="tel" name="phone" id="phone" class="form-control" value="<?= $userPhone; ?>">
										    </div>
										    <div class="form-group m-0">
											<label for="department" class="m-1">Department</label>
											<input type="text" name="department" id="department" class="form-control" value="<?= $userDepartment; ?>">
										    </div>

										    <div class="form-group mt-2">
											<input type="submit" name="updateProfile" id="ProfileUpdate" value="Update Profile" class="form-control btn btn-info btn-block">
										    </div>

									</form>
								</div>
							</div>
						</div>
						<!--Edit profile tab-->

						<!--change password tab content starts here-->
						<div class="tab-pane container fade" id="changePass">
							<div class="card-deck">
								<div class="card border-success">
									<div class="card-header bg-success text-white text-center lead">
										Change password
									</div>
									<form action="#" method="post" class="px-3 mt-2">
										<div class="form-group">
											<label for="currentPass">Enter your current password</label>
											<input type="password" name="currentPass" placeholder="Current Password" class="form-control form-control-lg" id="currentPass" required minlength="5">
										</div>
										<div class="form-group">
											<label for="newPass">Enter your new password</label>
											<input type="password" name="newPass" placeholder="New Password" class="form-control form-control-lg" id="newPass" required minlength="5">
										</div>
										<div class="form-group">
											<label for="confirmNewPass">Enter your new password</label>
											<input type="password" name="confirmNewPass" placeholder="New Password" class="form-control form-control-lg" id="confirmNewPass" required minlength="5">
										</div>

									   <div class="form-group">
									   	<input type="submit" name="changePass" class="btn btn-success btn-block btn-lg" id="changePassBtn" value="Submit">
									   </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		//profile update ajax request
		$("#ProfileUpdateForm").submit(function(e){
			e.preventDefault();

			$.ajax({
			url: 'php/process.php',
			method: 'post',
			processData: false,
			contentType: false,
			cache: false,
			data: new FormData(this),
			success:function(response){
				location.reload();
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
			})
		}
	});
</script>
</body>
</html>

