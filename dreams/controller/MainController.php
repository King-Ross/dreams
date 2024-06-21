<?php
namespace controller;

use model\Model;

class MainController{

    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function create_participant(){
        
        $this->model->create_participant();
    }

    public function update_participant($id){
        
        $this->model->update_participant($id);
    }


    public function create_lesson(){
        
        $this->model->create_lesson();
    }

    public function update_lesson($id){
       
        $this->model->update_lesson($id);
    }

    public function create_event(){
        
        $this->model->create_event();
    }

    public function update_event($id){
        
        $this->model->update_event($id);
    }

    public function create_material(){
        
        $this->model->create_material();
    }

    public function create_progress_row()
    {
        $this->model->create_progress_row();
    }

    public function create_encounter()
    {
        $this->model->create_encounter();
    }

}
?>