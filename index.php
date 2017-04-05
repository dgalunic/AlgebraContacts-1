<?php
	require_once 'core/init.php';
	
	Helper::getHeader('Algebra Contacts');
/*
	$db = DB::getInstance();

	$db->insert("users", array(
		'name'=>'Marko Horvat',
		'username'=>'Mark',
		'password'=>'58583456789',
		'salt'=>'5sdf1s5vsdfdsg5dc',
		'role_id'=>1));

//	$db->delete("users", array("id", ">=", 2, "AND", 'username', '=', 'Mark', "OR", 'role_id', '=' , 2));

	$db->get("*", "users", array('id', '>', 2, "AND", 'username', '=', 'Mark', "OR", 'role_id', '=' , 1));

	if($db->count() > 0) {
		foreach ($db->results() as $result) {
			echo $result->name . '<br />';
		}
	} else {
		echo 'Trenutno nema podataka u bazi!!!!';
	}
	*/	
?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="jumbotron">
                <div class="container">
                    <h1>Algebra Contacts</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et dolor sapien. Morbi faucibus, lacus a ornare finibus, justo nisl interdum turpis, et ornare diam libero eget leo.</p>
                    <p>
                        <a class="btn btn-primary btn-lg" href="login.php" role="button">Sign In</a>
                        or
                        <a class="btn btn-primary btn-lg" href="register.php" role="button">Create an account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
	Helper::getFooter();
?>

    
