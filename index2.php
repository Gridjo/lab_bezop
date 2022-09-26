<?ob_start();
session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"> 			
		<title>Задача 1</title>
	</head>
	<body>
		


		<?php
		if (isset($_GET['des'])) {
		    session_destroy();
		    header('Location: http://localhost/index2.php');
		}
			$host = 'localhost'; // имя хоста
			$user = 'Gridjo';      // имя пользователя
			$pass = 'Wertol123';          // пароль
			$name = 'lab_bezop';      // имя базы данных
			
			$link = mysqli_connect($host, $user, $pass, $name);
			if (isset($_POST['username'])) {
		        $username = $_POST['username'];
		        $password = $_POST['password'];
		        $query = mysqli_query($link, "SELECT * FROM users WHERE username='".$username."'");
		        if($query === FALSE) { 
			        die(mysqli_error($link)); // better error handling
			    }
		        $result = mysqli_fetch_assoc($query);

		        if (!$result) {
		            echo '<p class="error">222Неверные пароль или имя пользователя!</p>';
	        	} 

		        else {
		            if (md5($password) == $result['password']) {
		                $_SESSION['user_id'] = $result['id'];
		            } else {
		                echo '<p class="error">222222 Неверные пароль или имя пользователя!</p>';
		            }
		        }
    		}
    		
    		if (isset($_SESSION['user_id']) && isset($_POST['text'])){
    			mysqli_query($link,"UPDATE content SET content ='".$_POST['text']."' WHERE content.id = 1");
    		}
 		?>
			<?php
				$query1 = mysqli_query($link, "SELECT * FROM content WHERE id = 1");
		        $result1 = mysqli_fetch_assoc($query1);

			 if (!isset($_SESSION['user_id'])): 
			 	echo $result1['content'];?>

  		<form name="login" action="" method="POST">
		    <input type="text" name="username" placeholder="Username">
		    <input type="password" name="password" placeholder="Password">
		    <input type="submit" value="Login" id="login-form-submit">
		</form>
	<?php else: ?>
		<form name="text" action="" method="POST">
		    <? 
		    	
		        echo '<input type="text" name="text" value="';
		        echo $result1['content'];
		        echo '">';
		        ?>
		    <input type="submit" value="redact" id="login-form-submit">
		</form>
		<a href="index2.php/?des=true"> <button type="button" >EXIT</button></a>

	<?php endif; ?>
 		
	</body>
</html>

