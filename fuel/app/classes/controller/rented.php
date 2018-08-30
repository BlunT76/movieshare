<?php session_start();
class Controller_Rented extends Controller_Template
{

	public function action_index()
	{
		if(isset($_SESSION['role']) && $_SESSION['role']=='admin') {
		$data['renteds'] = Model_Rented::find('all');
		$this->template->title = "Renteds";
		$this->template->content = View::forge('rented/index', $data);
	}else {
		Response::redirect('film');
	}
	}

	public function action_view($id = null)
	{
		Response::redirect('film');
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
			$_SESSION['panier']="";
			Response::redirect('film');
			Session::set_flash('Success','Film emprunté(s)');
		}else {
			Session::set_flash('error','Not connected or buy list empty');
			$this->template->title= "Create";
			$this->template->content= View::forge('rented/create');
		}
	}

	public function action_edit($id = null)
	{
		Response::redirect('film');
	}

	public function action_delete($id = null)
	{
		if (isset($_POST['checkbox']))
		{
			$selected= $_POST['checkbox'];
			$rendu="";
			foreach ($selected as $v) {
				$available =Model_Film::find($v);
				$available->rented=0;
				$available->save();
				$rendu.=$available->title." /";
				$rented=Model_Rented::query()->from_cache(false)->where('film_id',$v)->get_one();
				$rented->delete();
			}
			Session::set_flash('success', 'Film(s) rendu(s) : '.$rendu);
			Response::redirect('film');
		}
		else
		{
			Session::set_flash('error', 'Selectionnez un film à rendre');
			Response::redirect('film');
		}
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
			Response::redirect('film');
		}
	}
	//La fonction ci-dessous nous renvoi depuis le panier jusqu'a la liste de films
	public function action_film()
	{
		Response::redirect('film');
	}
	public function action_clear()
	{
		if(isset($_SESSION['panier']))
		{
			$_SESSION['panier']="";
			Response::redirect('rented/progress');
		}else {
			Response::redirect('rented/progress');
		}
	}

}
