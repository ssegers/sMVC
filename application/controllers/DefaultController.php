<?php

namespace app\controllers;

use core\Controller;
use app\models\SiteConfigModel;

class DefaultController extends Controller {
    
    private SiteConfigModel $configDataModel;
    
    public function __construct() {
        parent::__construct();
        $this->configDataModel = new SiteConfigModel;
    }
    public function home()
    {
        $title = $this->configDataModel->title();
        $subTitle = $this->configDataModel->subTitle();
        $bigTitle = $this->configDataModel->mainTitle();
        $this->view->assign('title', $title);
        $this->view->assign('subTitle', $subTitle);
        $this->view->assign('bigTitle', $bigTitle);

        $this->view->assign('name', 'Johan');
        $content = $this->view->fetch('partialviews/home');
        $this->view->assign('content', $content);
        $this->view->display('layouts/main');
    }
    
}
