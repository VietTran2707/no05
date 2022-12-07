<?php 
	class Model extends Define
	{
		
		function __construct()
		{
			parent::__construct(); 
		}  
		
		
		public function login($idlogin,$pass)
			{
				$sql = "SELECT * FROM `admins` WHERE Login_id = :login_id AND Password = :passw AND actived_flag > 0";
				$pre = $this->pdo->prepare($sql);
				$pre->bindParam(':login_id', $idlogin);
				$pre->bindParam(':passw', $pass);
				$pre->execute();
				return $pre->fetchAll(PDO::FETCH_ASSOC);
			}
		
	
	}
?>
