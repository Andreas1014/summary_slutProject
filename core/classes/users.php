<?php
	class Users{

		private $db;

		public function __construct($database) {
			$this->db = $database;
		}

		public function user_exists($username){

			$query = $this->db->prepare("SELECT COUNT('id') FROM users WHERE username = ?");
			$query->bindValue(1, $username);

			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if ($rows == 1)
				{
					return true;
				} else
				{
					return false;
				}

			}catch (PDOException $e){
				die($e->getMessage());
			}
		}

		public function email_exists($email){

			$query = $this->db->prepare("SELECT COUNT('id') FROM users WHERE email = ?");
			$query->bindValue(1, $email);
		
			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if ($rows == 1)
				{
					return true;
				}else
				{
					return false;
				}

			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

		public function register($username, $password, $email){

			$time = time();
			$ip = $_SERVER['REMOTE_ADDR'];
			$email_code = sha1($username + microtime());
			$password = sha1($password);

			$query = $this->db->prepare("INSERT INTO users (username, password, email, ip, time, email_code) VALUES (?, ?, ?, ?, ?, ?) ");

			$query->bindValue(1, $username);
			$query->bindValue(2, $password);
			$query->bindValue(3, $email);
			$query->bindValue(4, $ip);
			$query->bindValue(5, $time);
			$query->bindValue(6, $email_code);

			try{
				$query->execute();
				
				//mail($email, 'Please activate your account', "Hello " . $username . ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://asjstrand.com/slutprojekt/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Andreas Sjöstrand", "From: andreas1014@hotmail.com");

			}catch(PDOException $e){
				die($e->getMessage());
			}
		}

		public function login($username, $password){

			$query = $this->db->prepare("SELECT password, id FROM users WHERE username = ?");
			$query->bindValue(1, $username);

			try{

				$query->execute();
				$data = $query->fetch();
				$stored_password = $data['password'];
				$id = $data['id'];

				if ($stored_password === sha1($password))
				{
					return $id;
				} else
				{
					return false;
				}

			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function userdata($id){
			
			$query = $this->db->prepare("SELECT * FROM users WHERE id = ?");
			$query->bindValue(1, $id);

			try{

				$query->execute();

				return $query->fetch();

			} catch(PDOException $e){
				die($e->getMessage());
			}
		}

		public function get_users(){

			$query = $this->db->prepare("SELECT * FROM users ORDER BY time DESC");

			try{
				$query->execute();
			} catch(PDOException $e){
				die($e->getMessage());
			}

			return $query->fetchAll();
		}
	}
?>