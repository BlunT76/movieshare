<?php
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
		if (Input::method() == 'POST')
		{
			$val = Model_Rented::validate('create');

			if ($val->run())
			{
				$rented = Model_Rented::forge(array(
					'user_id' => Input::post('user_id'),
					'film_id' => Input::post('film_id'),
				));

				if ($rented and $rented->save())
				{
					Session::set_flash('success', 'Added rented #'.$rented->id.'.');

					Response::redirect('rented');
				}

				else
				{
					Session::set_flash('error', 'Could not save rented.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Renteds";
		$this->template->content = View::forge('rented/create');

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

}
