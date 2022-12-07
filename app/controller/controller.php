<?php 
	class Controller extends Model
	{
		private $model;
		function __construct()
		{
			$this->model = new Model(); 
		}
		

		public function Controllers()
		{
			if (isset($_GET['page'])) {
                if($_GET['page'] != 'resetpassword'){
					if (isset($_SESSION['authen'])){
						$page =$_GET["page"];
					} else {
						$page ='login';
					}
				} else {
					$page = 'resetpassword';
				}
            } elseif(isset($_SESSION['authen'])){
				$page ='home';
			} else {
				$page ='login';
			}

            switch ($page) {
				case "home":
					include_once "./app/view/".$page.".php";
					break;
            	case 'login':
					date_default_timezone_set('Asia/Ho_Chi_Minh');
					$input_valid = true;
					$err_login="";
					$error = array(	"login_id"=>"",
									"password"=>"");
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["account"])) {
							$error["login_id"] = "Hãy nhập login id";
							$input_valid = false;
						} elseif (strlen($_POST["account"])<4) {
							$error["login_id"]="Hãy nhập login tối thiểu 4 ký tự";
							$input_valid = false;
						}
						if (empty($_POST["password"])) {
							$error["password"] = "Hãy nhập password";
							$input_valid = false;
						} elseif (strlen($_POST["password"])<6) {
							$error["password"]="Hãy nhập password tối thiểu 6 ký tự";
							$input_valid = false;
						}

						if ($input_valid) {
							if (isset($_POST['submit_login'])) {
								$idlogin = $_POST['account'];
								$pass = md5($_POST['password']);
								$admin = $this->model->login($idlogin, $pass);
								if (!empty($admin)) {
									foreach ($admin as $rowAdmin) {
										$_SESSION['authen']= $rowAdmin;
										
										$_SESSION['timelogin'] = date("Y-m-d h:i:s");
										header('Location:index.php');
									}
								}else {
									$err_login = "Login ID và password không đúng";
								}
							}
						}
					}

            		include_once "./".$page.".php";
					break;
				case "logout":
					unset($_SESSION['authen']);
					header('Location:index.php');
					break;
				case "resetpassword":


					include_once "./app/view/".$page.".php";
					break;
				
				}
				
		}
	}

?>