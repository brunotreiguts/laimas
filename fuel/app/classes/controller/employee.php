<?php

class Controller_Employee extends Controller_Public {

    public function action_index() {
        $data['employees'] = Model_Employee::find('all');
        $this->template->title = __('EMPLOYEE_HEADER');
        $this->template->content = View::forge('employee/index', $data);
    }

    public function action_create() {

        if (Auth::has_access('employee.create')) {
            if (Input::method() == 'POST') {


                $val = Model_Employee::validate('create');

                if ($val->run()) {

                    $config = array(
                        'path' => DOCROOT . DS . 'assets/img/employee/',
                        'randomize' => true,
                        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                    );

                    Upload::process($config);
                    if (Upload::is_valid()) {
                        Upload::save();

                        $filename = Upload::get_files()[0]['saved_as'];

                        Session::set_flash('success', 'Attēls pievienots veiksmīgi!');
                    } else {

                        Session::set_flash('error', 'Image not valdid');
                        Response::redirect('employee/create');
                    }

                    $employee = Model_Employee::forge(array(
                                'name' => Input::post('name'),
                                'surname' => Input::post('surname'),
                                'email' => Input::post('email'),
                                'phonenumber' => Input::post('phonenumber'),
                                'description' => Input::post('description'),
                                'avatar' => $filename,
                    ));

                    if ($employee and $employee->save()) {
                        Session::set_flash('success', 'Added employee #' . $employee->id . '.');

                        Response::redirect('employee');
                    } else {
                        Session::set_flash('error', 'Could not save employee.');
                    }
                } else {
                    Session::set_flash('error', $val->error());
                }
            }
            $this->template->title = __('EMPLOYEE_HEADER');
            $this->template->content = View::forge('employee/create');
        } else {
            Response::redirect('404');
        }
    }

    public function action_edit($id = null) {
        if (Auth::has_access('employee.manage')) {
            is_null($id) and Response::redirect('employee');

            if (!$employee = Model_Employee::find($id)) {
                Session::set_flash('error', 'Could not find employee #' . $id);
                Response::redirect('employee');
            }

            $val = Model_Employee::validate('edit');

            if ($val->run()) {

                $upload = Input::post('upload');
                if ($upload === '1') {

                    $employee->name = Input::post('name');
                    $employee->surname = Input::post('surname');
                    $employee->email = Input::post('email');
                    $employee->phonenumber = Input::post('phonenumber');
                    $employee->description = Input::post('description');
                } elseif ($upload === '2') {

                    $config = array(
                        'path' => DOCROOT . DS . 'assets/img/employee/',
                        'randomize' => true,
                        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                    );

                    $filename = null;

                    Upload::process($config);
                    if (Upload::is_valid()) {

                        $oldfile = $employee->avatar;
                        Upload::save();

                        $filename = Upload::get_files()[0]['saved_as'];

                        File::delete(DOCROOT . 'assets/img/employee/' . $oldfile);
                        Session::set_flash('success', 'Attēls pievienots veiksmīgi!');
                    } else {
                        Session::set_flash('error', 'Image not valdid');
                        Response::redirect('employee/edit/' . $id);
                    }


                    $employee->name = Input::post('name');
                    $employee->surname = Input::post('surname');
                    $employee->email = Input::post('email');
                    $employee->phonenumber = Input::post('phonenumber');
                    $employee->description = Input::post('description');
                    if ($filename != null) {
                        $employee->avatar = $filename;
                    } else {
                        $employee->avatar = Input::post('avatar');
                        Session::set_flash('error', 'Could not upload picture');
                    }
                }

                if ($employee->save()) {
                    Session::set_flash('success', 'Updated employee #' . $upload);

                    Response::redirect('employee');
                } else {
                    Session::set_flash('error', 'Could not update employee #' . $id);
                }
            } else {
                if (Input::method() == 'POST') {

                    $employee->name = $val->validated('name');
                    $employee->surname = $val->validated('surname');
                    $employee->email = $val->validated('email');
                    $employee->phonenumber = $val->validated('phonenumber');
                    $employee->description = $val->validated('description');
                    $employee->avatar = $val->validated('avatar');

                    Session::set_flash('error', $val->error());
                }

                $this->template->set_global('employee', $employee, false);
            }

            $this->template->title = __('EMPLOYEE_HEADER');
            $this->template->content = View::forge('employee/edit');
        } else {
            Response::redirect('404');
        }
    }

    public function action_delete($id = null) {
        if (Auth::has_access('employee.manage')) {
            is_null($id) and Response::redirect('employee');

            if ($employee = Model_Employee::find($id)) {

                $filename = $employee->avatar;
                File::delete(DOCROOT . 'assets/img/employee/' . $filename);


                $employee->delete();

                Session::set_flash('success', 'Deleted employee #' . $id);
            } else {
                Session::set_flash('error', 'Could not delete employee #' . $id);
            }

            Response::redirect('employee');
        } else {
            Response::redirect('404');
        }
    }

}
