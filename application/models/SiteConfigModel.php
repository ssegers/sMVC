<?php

namespace app\models;
use core\Model;

class SiteConfigModel extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function title(){
        return "Oefeningen";
    }
    
    public function mainTitle(){
        return "PHP en MySql";
    }
    
    public function subTitle(){
        return "professioneel Webdesign in een MVC structuur";
    }
}
