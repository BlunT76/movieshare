<?php session_start();
class Controller_Film extends Controller_Template
{
	
	public function action_index()
	{
		if (isset($_SESSION['login'])) {
			$data['films'] = Model_Film::find('all');
			$this->template->title = "Films";
			$this->template->content = View::forge('film/index', $data);
		} else {
			Session::set_flash('error', 'not logged');
			Response::redirect('login');
		}
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('film');

		if ( ! $data['film'] = Model_Film::find($id))
		{
			Session::set_flash('error', 'Could not find film #'.$id);
			Response::redirect('film');
		}

		$this->template->title = "Film";
		$this->template->content = View::forge('film/view', $data);

	}

	public function action_create()
	{
        if (isset($_SESSION['role']) && $_SESSION['role']== 'admin') {
            if (Input::method() == 'POST') {
                $val = Model_Film::validate('create');

                if ($val->run()) {
                    $film = Model_Film::forge(array(
                    'title' => Input::post('title'),
                    'year' => Input::post('year'),
                    'director' => Input::post('director'),
                    'actors' => Input::post('actors'),
                    'runtime' => Input::post('runtime'),
                    'plot' => Input::post('plot'),
                    'rented' => Input::post('rented'),
                    'poster' => Input::post('poster'),
                ));

                    if ($film and $film->save()) {
                        Session::set_flash('success', 'Added film #'.$film->id.'.');

                        Response::redirect('film');
                    } else {
                        Session::set_flash('error', 'Could not save film.');
                    }
                } else {
                    Session::set_flash('error', $val->error());
                }
            }

            $this->template->title = "Films";
            $this->template->content = View::forge('film/create');
        }
	}

	public function action_edit($id = null)
	{
        if (isset($_SESSION['role']) && $_SESSION['role']== 'admin') {
            is_null($id) and Response::redirect('film');

            if (! $film = Model_Film::find($id)) {
                Session::set_flash('error', 'Could not find film #'.$id);
                Response::redirect('film');
            }

            $val = Model_Film::validate('edit');

            if ($val->run()) {
                //$film->title = Input::post('title');
                $film->year = Input::post('year');
                $film->director = Input::post('director');
                $film->actors = Input::post('actors');
                $film->runtime = Input::post('runtime');
                $film->plot = Input::post('plot');
                $film->rented = Input::post('rented');
                $film->poster = Input::post('poster');

                if ($film->save()) {
                    Session::set_flash('success', 'Updated film #' . $id);

                    Response::redirect('film');
                } else {
                    Session::set_flash('error', 'Could not update film #' . $id);
                }
            } else {
                if (Input::method() == 'POST') {
                    $film->title = $film->title; //$val->validated('title');
                    $film->year = $val->validated('year');
                    $film->director = $val->validated('director');
                    $film->actors = $val->validated('actors');
                    $film->runtime = $val->validated('runtime');
                    $film->plot = $val->validated('plot');
                    $film->rented = $val->validated('rented');
                    $film->poster = $val->validated('poster');

                    Session::set_flash('error', $val->error());
                }

                $this->template->set_global('film', $film, false);
            }

            $this->template->title = "Films";
            $this->template->content = View::forge('film/edit');
        } else {
			Response::redirect('film');
		}
	}

	public function action_delete($id = null)
	{
        if (isset($_SESSION['role']) && $_SESSION['role']== 'admin') {
            is_null($id) and Response::redirect('film');

            if ($film = Model_Film::find($id)) {
                $film->delete();

                Session::set_flash('success', 'Deleted film #'.$id);
            } else {
                Session::set_flash('error', 'Could not delete film #'.$id);
            }

            Response::redirect('film');
        }
    }
}
