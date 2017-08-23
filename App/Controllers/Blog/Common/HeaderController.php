<?php

namespace App\Controllers\Blog\Common;

use System\Controller;

class HeaderController extends Controller
{

    public function index()
    {
        $icon               = $this->load->model('Settings')->get(8)->v;
        $data['icon']       = $this->url->link('Public/uploads/img/') . '/' . $icon;
        $data['title']      = $this->html->getTitle();
        $data['site_name']  = $this->load->model('Settings')->get(1)->v;
        $loginModel         = $this->load->model('Login');
        $data['user']       = $loginModel->isLogged() ? $loginModel->user() : null;
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();
        return $this->view->render('blog/common/header', $data)->getOutput();
    }

}
