<?php session_start();
class Controller_Film extends Controller_Template
{
    public function action_index()
    {
        if (isset($_SESSION['login'])) {
            if (Input::method() == 'POST') {
                if (isset($_POST['rented'])) {
                    $rented = 0;
                    $data['films'] = Model_Film::find('all', array(
                        'where' => array(
                            array('rented', $rented),
                        ),
                        'order_by'=> array($_POST['sort'] =>'asc')
                    ));
                    $this->template->title = "Films";
                    $this->template->content = View::forge('film/index', $data);
                } else {
                    $data['films'] = Model_Film::find('all', array(
                        'order_by'=> array($_POST['sort'] =>'asc')
                    ));
                    $this->template->title = "Films";
                    $this->template->content = View::forge('film/index', $data);
                }
            } else {
                $data['films'] = Model_Film::find('all');
                $rented = Model_Rented::query()->from_cache(false)->where('user_id', '=', $_SESSION['id'])->get();
                $data['rented']=[];
                foreach ($rented as $v) {
                    $transit=Model_Film::find($v['film_id']);
                    array_push($data['rented'], $transit);
                }
                $this->template->title = "Films";
                $this->template->content = View::forge('film/index', $data);
            }
        } else {
            Session::set_flash('error', 'not logged');
            Response::redirect('login');
        }
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('film');

        if (isset($_SESSION['login'])) {

            if (! $data['film'] = Model_Film::find($id)) {
                Session::set_flash('error', 'Could not find film #'.$id);
                Response::redirect('film');
            }

            $this->template->title = "Film";
            $this->template->content = View::forge('film/view', $data);
        } else {
            Session::set_flash('error','You are not connected');
            Response::redirect('login');
        }
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
        } else {
            Response::redirect('login');
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
    public function action_populate()
    {
        $this->template->title = "Ffdtgfgtrms";
        $this->template->content = View::forge('film/populate');
    }

    public function action_newFilm()
    {
        if (isset($_SESSION['role']) && $_SESSION['role']== 'admin') {
            if (Input::method() == 'POST') {
                require 'apikey.php';
                $e = str_replace(' ', '+', Input::post('search'));
                $json = file_get_contents($api.$e, FILE_USE_INCLUDE_PATH);
                $info = json_decode($json, true);

                $data = array();
                $data["title"] = (isset($info["Title"]) ? $info["Title"] : null);
                $data["director"] = (isset($info["Director"]) ? $info["Director"] : null);
                $data["actors"] = (isset($info["Actors"]) ? $info["Actors"] : null);
                $data["year"] = (isset($info["Year"]) ? $info["Year"] : null);
                $data["runtime"] = (isset($info["Runtime"]) ? $info["Runtime"] : null);
                $data["plot"] = (isset($info["Plot"]) ? $info["Plot"] : null);
                $data["poster"] = (isset($info["Poster"]) ? $info["Poster"] : null);

                $this->template->title = "Films";
                $this->template->content = View::forge('film/resultfilm', array('data'=>$data));
            //$this->template->content = View::forge('film/view', $arr);
            } else {
                $this->template->title = "Films";
                $this->template->content = View::forge('film/newfilm');
            }
        }else {
            Response::redirect('login');
        }
    }
    
    public function action_resultfilm()
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

                        Response::redirect('/film/newfilm');
                    } else {
                        Session::set_flash('error', 'Could not save film.');
                        Response::redirect('/film/newfilm');
                    }
                } else {
                    Session::set_flash('error', $val->error());
                    //Response::redirect('/film/newfilm');
                }
                $this->template->title = "Films";
                $this->template->content = View::forge('film/create');
            } else {
                $this->template->title = "Films";
                $this->template->content = View::forge('film/newfilm');
            }
        }else {
            Resopnse::redirect('login');
        }
    }
    public function action_loan($id = null)
    {
        if (isset($_SESSION['role'])) {
            is_null($id) and Response::redirect('film');

            if (! $film = Model_Film::find($id)) {
                Session::set_flash('error', 'Could not find film #'.$id);
                Response::redirect('film');
            }
            if ($_SESSION['panier'].=$id." ") {
                Session::set_flash('success', 'Film ajouté');
                Response::redirect('film');
            //Response::redirect('film');
            } else {
                Session::set_flash('error', 'Could not loan film #' . $id);
            }
        } else {
            Response::redirect('login');
        }
    }

    public function action_searchfilm()
    {
        if(isset($_SESSION['login'])){
        if (isset($_POST['searchfilm'])) {

            $who = '%'.$_POST['searchfilm'].'%';
            $data['films'] = DB::select()->from('films')->as_object()->where('title', 'like', $who)->or_where('plot', 'like', $who)->execute();

            $this->template->title = "Films";
            $this->template->content = View::forge('film/index', $data);
        }
    }else{
        Response::redirect('login');
    }
    }
}
