<?php session_start();
class Controller_User extends Controller_Template
{

	public function action_index()
	{
		$data['users'] = Model_User::find('all');
		$this->template->title = "Users";
		$this->template->content = View::forge('user/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('user');

		if ( ! $data['user'] = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('user');
		}

		$this->template->title = "User";
		$this->template->content = View::forge('user/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');

			if ($val->run())
			{
				$user = Model_User::forge(array(
					'username' => Input::post('username'),
					'password' => password_hash(Input::post('password'), PASSWORD_DEFAULT),
					'email' => Input::post('email'),
					'role' => 'user', // Input::post('role'),
				));

				if ($user and $user->save())
				{
					Session::set_flash('success', 'Added user #'.$user->id.'.');

					Response::redirect('user');
				}

				else
				{
					Session::set_flash('error', 'Could not save user.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Subscribe";
		$this->template->content = View::forge('user/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('user');

		if ( ! $user = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('user');
		}

		$val = Model_User::validate('edit');

		if ($val->run())
		{
			$user->username = Input::post('username');
			$user->password = password_hash(Input::post('password'), PASSWORD_DEFAULT);
			$user->email = Input::post('email');
			$user->role = $user->role; //Input::post('role'); //modified by philippe

			if ($user->save())
			{
				Session::set_flash('success', 'Updated user #' . $id);

				Response::redirect('user');
			}

			else
			{
				Session::set_flash('error', 'Could not update user #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user->username = $val->validated('username');
				$user->password = $val->validated('password');
				$user->email = $val->validated('email');
				$user->role = $user->role; //$val->validated('role');  //modified by philippe

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user', $user, false);
		}

		$this->template->title = "Users";
		$this->template->content = View::forge('user/edit');

	}

	public function action_delete($id = null)
	{
        
            is_null($id) and Response::redirect('user');

            if ($user = Model_User::find($id)) {
                $user->delete();

                Session::set_flash('success', 'Deleted user #'.$id);
            } else {
                Session::set_flash('error', 'Could not delete user #'.$id);
            }

            Response::redirect('user');
       
	}

	public function action_login(){
		if (Input::method() == 'POST'){
			if ($user = Model_User::query()->where('username', Input::post('username'))->get_one()->to_array()){
				if(password_verify(Input::post('password'),$user['password'])){
					$_SESSION['login']= $user['username'];
					$_SESSION['role']= $user['role'];
					$_SESSION['id']= $user['id'];
					$_SESSION['panier']=""; 
					Response::redirect('film');
				}
			} else {
				Session::set_flash('error', 'Username or password error');
			}
		} 
		$this->template->title = "Login";
		$this->template->content = View::forge('user/login');
		if(isset($_SESSION['id'])){
			Response::redirect('film');
		}
	}

	public function action_logout(){
		session_destroy();
		Response::redirect('login');
	}
}
