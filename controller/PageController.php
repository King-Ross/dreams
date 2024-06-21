<?php

namespace controller;

use core\Session;
use model\Model;
use model\User;
use view\BladeView;

class PageController
{
    private $app_name;
    private $app_name_full;
    private $app_base_url;
    private $blade_view;
    private $model;
    private $user_model;

    public function __construct()
    {
        $this->app_name = getenv("APP_NAME");
        $this->app_name_full = getenv("APP_NAME_FULL");
        $this->app_base_url = getenv("APP_BASE_URL");
        $this->blade_view = new BladeView();
        $this->model = new Model();
        $this->user_model = new User();
    }

    public function render_404()
    {
        $html = $this->blade_view->render('404', [
            'pageTitle' => " $this->app_name page not found",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),

        ]);

        echo ($html);
    }

    public function render_dashboard()
    {
        $participantsCount = $this->model->get_participants_count();
        $eventsCount = $this->model->get_events_count();
        $lessonsCount = $this->model->get_lessons_count();

        $html = $this->blade_view->render('dashboard', [
            'pageTitle' => " $this->app_name dashboard",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'partcipantsCount' => $participantsCount,
            'eventsCount' => $eventsCount,
            'lessonsCount' => $lessonsCount,

        ]);

        echo ($html);
    }

    public function render_register_participant($action = null, $id = null)
    {
        $participants = $this->model->get_participants();
        $participantDetails = $this->model->get_participant_details($id);

        $html = $this->blade_view->render('managePaticipants', [
            'pageTitle' => " $this->app_name register participant",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'participants' => $participants['response'],
            'action' => $action,
            'participantDetails' => $participantDetails['response'],
        ]);

        echo ($html);
    }

    public function render_lessons($action = null, $id = null)
    {
        $lessons = $this->model->get_lessons();
        $lessonDetails = $this->model->get_lesson_details($id);

        $html = $this->blade_view->render('manageLessons', [
            'pageTitle' => " $this->app_name lessons",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'lessons' => $lessons['response'],
            'action' => $action,
            'lessonDetails' => $lessonDetails['response'],
        ]);

        echo ($html);
    }


    public function render_events($action = null, $id = null)
    {
        $events = $this->model->get_events();
        $event_details = $this->model->get_event_details($id);

        $html = $this->blade_view->render('manageEvents', [
            'pageTitle' => " $this->app_name events",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'events' => $events['response'],
            'action' => $action,
            'eventDetails' => $event_details['response'],
        ]);

        echo ($html);
    }

    public function render_materials()
    {
        $materials = $this->model->get_materials();

        $html = $this->blade_view->render('manageMaterials', [
            'pageTitle' => " $this->app_name events",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'materials' => $materials['response'],
        ]);

        echo ($html);
    }

    public function render_add_progress($id)
    {
        $result_one = $this->model->get_events();
        $result_two = $this->model->get_lessons();
        $result_three = $this->model->get_individual_progress($id);

        $html = $this->blade_view->render('manageProgress', [
            'pageTitle' => " $this->app_name add progress",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'events' => $result_one['response'],
            'lessons' => $result_two['response'],
            'participantId' => $id,
            'progress' => $result_three['response'],
        ]);

        echo ($html);
    }

    public function render_participants_progress()
    {
        $result_three = $this->model->get_progress();

        $html = $this->blade_view->render('allParticipantProgress', [
            'pageTitle' => " $this->app_name participants progress",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'progress' => $result_three['response'],
        ]);

        echo ($html);
    }

    public function render_reports()
    {
        $result_three = $this->model->get_progress();

        $html = $this->blade_view->render('reports', [
            'pageTitle' => " $this->app_name reports",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'progress' => $result_three['response'],
        ]);

        echo ($html);
    }

    public function render_view_encounters($id)
    {
        
        $result_one = $this->model->get_events();
        $result_two = $this->model->get_lessons();
        $result_three = $this->model->get_materials();
        $result_four = $this->model->get_encounters($id);

        $html = $this->blade_view->render('viewEncounters', [
            'pageTitle' => " $this->app_name encounters",
            'appName' => $this->app_name,
            'baseUrl' => $this->app_base_url,
            'appNameFull' => $this->app_name_full,
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'events' => $result_one['response'],
            'lessons' => $result_two['response'],
            'materials' => $result_three['response'],
            'encounters' => $result_four['response'],
            'participantId' => $id,
            
        ]);

        echo ($html);
    }

    
}
