<?php

class Controller_Users extends Controller_Public {

    public function action_view($id) {
        $user = Model_User::find($id);

        $this->template->title = 'Profils: ' . $user->username;
        $this->template->content = View::forge('users/view', array(
                    'user' => $user,
                        )
        );
    }
    
        public function action_panel($id) {
        $user = Model_User::find($id);

        $this->template->title = 'Profils: ' . $user->username;
        $this->template->content = View::forge('users/panel', array(
                    'user' => $user,
                        )
        );
    }

    public function action_login() {
        if (Input::method() == 'POST') {
            if (Auth::login(Input::post('username'), Input::post('password'))) {
                Session::set_flash('success', 'Jūs esat veiksmīgi pierakstījies sistēmā!');
                Response::redirect_back('users/panel');
            } else {
                
                Session::set_flash('error', 'Nepareizi pieejas dati!');
                Response::redirect_back('users/login');
              //  exit('Nepareizi pieejas dati!');
            }
        }
        $this->template->title = 'Pierakstīšanās sistēmā';
        $this->template->content = View::forge('users/login');
    }

    public function action_logout() {
        Auth::logout();
        Session::set_flash('success', 'Jūs veiksmīgi izrakstījāties no sistēmas');
        Response::redirect('welcome');
    }
    
}
