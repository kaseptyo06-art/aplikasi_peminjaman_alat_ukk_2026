<?php
class Controller {
    public function model($model) {
        require_once __DIR__ . "/model.php";
        require_once __DIR__ . "/../models/" . $model . ".php";
        return new $model();
    }

    public function view($view, $data = []) {
        if (!empty($data) && is_array($data)) {
            extract($data, EXTR_SKIP);
        }
        require_once __DIR__ . "/../../views/" . $view . ".php";
    }
}