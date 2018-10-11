<?php

namespace app\Controllers\Blog;

use System\Controller;

class HomeController extends Controller
{

    /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle($this->load->model('Settings')->get(1)->v);
        $data['posts']      = $this->load->model('Posts')->latest();
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();
        $data['ads']        = $this->load->model('Ads')->enabled();
        $postController     = $this->load->controller('Blog/Post');
        $data['post_box']   = function ($post) use ($postController) {
            return $postController->box($post);
        };
// i will use getOutput() method just to display errors
// as i'm using php 7 which is throwing all errors as exceptions
// which won't be thrown through the __toString() method
        $view = $this->view->render('blog/home', $data);

        return $this->blogLayout->render($view);
    }

}
