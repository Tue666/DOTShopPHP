<?php  
class Login extends ViewModel{
	public $accounts;
	function __construct(){
		$this->accounts = $this->getModel('Account');
	}
	public function Index(){
		$this->loadView('Login','Index');
	}
	public function Register(){
		if (isset($_POST['register-btn'])) {
			$userName = $_POST['regis-un'];
			$passWord = $_POST['regis-ps'];
			$confirmPassword = $_POST['regis-confirmps'];
			if ($passWord != $confirmPassword) {
				$this->loadView('Login','Index',[
					'message' => 'Passwords are not synchronized :D',
					'type' => 'error'
				]);
			}
			else {
				if (json_decode($this->accounts->checkExist($userName))) {
					$this->loadView('Login','Index',[
						'message' => 'This name is already existed :D',
						'type' => 'error'
					]);
				}
				else {
					$passWord = password_hash($passWord, PASSWORD_DEFAULT);
					if (json_decode($this->accounts->insertAccount($userName,$passWord))){
						$this->loadView('Login','Index',[
							'message' => 'Register successfully :D',
							'type' => 'success'
						]);
					}
					else{
						$this->loadView('Login','Index',[
							'message' => 'Register failed :D',
							'type' => 'error'
						]);
					}
				}
			}
		}
	}
	public function Login(){
		if (isset($_POST['login-btn'])) {
			$userName = $_POST['login-username'];
			$passWord = $_POST['login-password'];
			if (password_verify($passWord, $this->accounts->checkLogin($userName))) {
				$_SESSION['USER_SESSION'] = $userName;
				header('Location:'.BASE_URL);
			}
			else{
				$this->loadView('Login','Index',[
					'message' => 'Username or Passwords is incorrect :D',
					'type' => 'error'
				]);
			}
		}
	}
	public function Logout(){
		session_destroy();
		header('Location:'.BASE_URL.'Login/Index');
	}
}
?>