<?php session_start();
class Controller_Rented extends Controller_Template
{

	public function action_index()
	{
		$data['renteds'] = Model_Rented::find('all');
		$this->template->title = "Renteds";
		$this->template->content = View::forge('rented/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('rented');

		if ( ! $data['rented'] = Model_Rented::find($id))
		{
			Session::set_flash('error', 'Could not find rented #'.$id);
			Response::redirect('rented');
		}

		$this->template->title = "Rented";
		$this->template->content = View::forge('rented/view', $data);

	}

	public function action_create()
	{
		if(isset($_SESSION['id']) && isset($_SESSION['panier']))
		{
			$ids=explode(" ", $_SESSION['panier']);
			$ids=array_unique($ids);
			foreach ($ids as $v) {
				if($v!=""){
					$rented = Model_rented::forge(array(
						'user_id' => $_SESSION['id'],
						'film_id' => $v
					));
				}
				if($rented->save() && $film = Model_film::find($v)){
					$film->rented = 1;
					$film->save();
				}
			}
			Response::redirect('film');
			Session::set_flash('Success','Film emprunté(s)');
			$_SESSION['panier']="";
		}else {
			Session::set_flash('error','Could not find session id or panier');
			$this->template->title= "Create";
			$this->template->content= View::forge('rented/create');
		}
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('rented');

		if ( ! $rented = Model_Rented::find($id))
		{
			Session::set_flash('error', 'Could not find rented #'.$id);
			Response::redirect('rented');
		}

		$val = Model_Rented::validate('edit');

		if ($val->run())
		{
			$rented->user_id = Input::post('user_id');
			$rented->film_id = Input::post('film_id');

			if ($rented->save())
			{
				Session::set_flash('success', 'Updated rented #' . $id);

				Response::redirect('rented');
			}

			else
			{
				Session::set_flash('error', 'Could not update rented #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$rented->user_id = $val->validated('user_id');
				$rented->film_id = $val->validated('film_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rented', $rented, false);
		}

		$this->template->title = "Renteds";
		$this->template->content = View::forge('rented/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('rented');

		if ($rented = Model_Rented::find($id))
		{
			$rented->delete();

			Session::set_flash('success', 'Deleted rented #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete rented #'.$id);
		}

		Response::redirect('rented');

	}
	public function action_progress()
	{
		if(isset($_SESSION['panier'])){
			$panier=[];
			$ids=explode(" ", $_SESSION['panier']);
			$ids=array_unique($ids);
			foreach ($ids as $v) {
				if ($v!="") {
					if($film=Model_Film::find($v)){
						array_push($panier, $film);
					}
				}
			}			
			if(!empty($panier)){
				$data['panier']=$panier;
				$this->template->title="Panier";
				$this->template->content= View::forge('rented/progress',$data);
			}else{
				$this->template->title="Panier";
				$this->template->content= View::forge('rented/progress');
			}
		}else{
			$this->template->title="Panier";
			$this->template->content= View::forge('rented/progress');
		}
	}
	//La fonction ci-dessous nous renvoi depuis le panier jusqu'a la liste de films
	public function action_film()
	{
		Response::redirect('film');
	}

}
