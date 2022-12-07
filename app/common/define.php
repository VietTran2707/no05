<?php  
	class Define extends Database
	{
        protected $pdo = null;
		function __construct()
		{
            $db = new Database();
            try{
                $this->pdo = new PDO($db->get_dns(), $db->get_user(), $db->get_user());
                $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo $e->getMessage();
				exit();
            }
		}
	}

?>