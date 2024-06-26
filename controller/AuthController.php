<?php

namespace controller;

use core\Request;
use Illuminate\Support\Facades\URL;
use core\Session;
use core\Uploader;
use model\Model;
use model\User;
use view\BladeView;

class AuthController
{
   
    private $app_name;
    private $app_name_full;
    private $app_base_url;
    private $user_model;
    private $model;

    public function __construct()
    {
        $this->app_name = getenv("APP_NAME");
        $this->app_name_full = getenv("APP_NAME_FULL");
        $this->app_base_url = getenv("APP_BASE_URL");
        $this->user_model = new User();
        $this->model = new Model();
    }
    
    public function index()
    {
        $blade_view = new BladeView();
        $html = $blade_view->render('/auth/login', [
            'pageTitle' => "$this->app_name Auth-Login",
            'appName' => $this->app_name,
            'appNameFull' => $this->app_name_full,
        ]);

        echo ($html);
    }

    public function render_home()
    {
        $programe = $this->model->get_current_programe();
        $blade_view = new BladeView();
        $html = $blade_view->render('home', [
            'pageTitle' => "$this->app_name Welcome",
            'appName' => $this->app_name,
            'appNameFull' => $this->app_name_full,
            'programe' => $programe['response'],
        ]);

        echo ($html);
    }

    public function render_register_view()
    {
        $blade_view = new BladeView();
        $html = $blade_view->render('/auth/register', [
            'pageTitle' => "$this->app_name Auth-Register",
            'appName' => $this->app_name,
            'appNameFull' => $this->app_name_full,
        ]);

        echo ($html);
    }

    public function render_create_profile_view()
    {
        $blade_view = new BladeView();
        $html = $blade_view->render('/auth/createProfile', [
            'pageTitle' => "$this->app_name Auth-Register",
            'appName' => $this->app_name,
            'username' => Session::get('username'),
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
        ]);

        echo ($html);
    }

    public function render_show_profile_view()
    {
      
        $userDetails = $this->user_model->get_all_user_data(Session::get('user_id'));

        $blade_view = new BladeView();
        $html = $blade_view->render('/auth/viewProfile', [
            'pageTitle' => "$this->app_name - Dashboard",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'userDetails' => $userDetails
        ]);

        echo ($html);
    }

    public function sign_in_user()
    {
       
        $this->user_model->login();
    }

    public function sign_out()
    {
        Session::destroy();
        header("location:/$this->app_name/auth/challenge/login/");
    }

    public function create_account()
    {
      
        $this->user_model->add_user();
    }

    public function upload_photo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $uploader = new Uploader('image');
            $uploader->save_in("../$this->app_name/uploads/images/");

            if ($uploader->save()) {
                // Return the URL of the uploaded image
                echo $uploader->get_file_name();
            } else {
                http_response_code(500);
                echo 'Error uploading image.';
            }
        }
    }

    public function check_nin()
    {
        
        $this->user_model->check_nin();
    }
    public function check_email()
    {
        
        $this->user_model->check_email();
    }

    public function save_profile()
    {
        
        $this->user_model->save_profile();
    }

    public function update_profile()
    {
        
        $this->user_model->update_profile();
    }

    public function update_photo()
    {
       
        $this->user_model->update_photo();
    }

    public function check_password($password)
    {
        
        $this->user_model->check_password($password);
    }

    public function change_password()
    {
        
        $this->user_model->change_password();
    }

    public function get_user_details()
    {
        
        $userDetails = $this->user_model->get_all_user_data(Session::get('user_id'));
        Request::send_response(200, $userDetails);
    }
}
