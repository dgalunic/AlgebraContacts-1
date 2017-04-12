<?php
	require_once 'core/init.php';
	
	$validation = new Validation();
	$token = new Token();
	
	if(Input::exists()) {
		if($token->check(Input::get('token'))) {
			$validate = $validation->check(array(
				'name'            => array(
					'required' => true,
					'min'      => 2,
					'max'      => 50
				),
				'username'        => array(
					'required' => true,
					'min'      => 2,
					'max'      => 20,
					'unique'   => 'users'
				),
				'password'        => array(
					'required' => true,
					'min'      => 8
				),
				'confirm_password'  => array(
					'required' => true,
					'matches'  => 'password'
				)
			));
			
			if($validate->passed()) {
				
				$salt = Hash::salt(32);
				$password = Hash::make(Input::get('password'), $salt);			
				
				Session::flash('success', 'You registred successfully!');
				//Redirect::to('login');

			}
		} 
	}
	
	Helper::getHeader('Algebra Contacts');
	
?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Create an account</h3>
			</div>
			<div class="panel-body">
				<form method="post">
					<input type="hidden" name="token" value="<?php echo $token->generate(); ?>">
					<div class="form-group <?php echo ($validation->hasError('name')) ? 'has-error' : ''; ?>">
						<label for="name" class="control-label">Name*</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo escape(Input::get('name'))?>">
						<?php echo ($validation->hasError('name')) ? '<p class="text-danger">'.$validation->hasError('name').'</p>' : '';?>
					</div>
					<div class="form-group <?php echo ($validation->hasError('username')) ? 'has-error' : ''; ?>">
						<label for="username" class="control-label">Username*</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autocomplete="off">
						<?php echo ($validation->hasError('username')) ? '<p class="text-danger">'.$validation->hasError('username').'</p>' : '';?>
					</div>
					<div class="form-group <?php echo ($validation->hasError('password')) ? 'has-error' : ''; ?>">
						<label for="password" class="control-label">Password*</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Choose a password">
						<?php echo ($validation->hasError('password')) ? '<p class="text-danger">'.$validation->hasError('password').'</p>' : '';?>
					</div>
					<div class="form-group <?php echo ($validation->hasError('confirm_password')) ? 'has-error' : ''; ?>">
						<label for="confirm_password" class="control-label">Confirm Password*</label>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter your password again">
						<?php echo ($validation->hasError('confirm_password')) ? '<p class="text-danger">'.$validation->hasError('confirm_password').'</p>' : '';?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Create an account</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	Helper::getFooter();
?>
