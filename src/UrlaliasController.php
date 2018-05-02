<?php

namespace dmcdenissen\urlalias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use dmcdenissen\urlalias\Urlalias;

class UrlaliasController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
    * Return controller view by Urlalias
    *
    * @param str $slug URL
    * @return \Illuminate\Http\Response
    */
    public function index($slug) 
    {
        $urlObj = Urlalias::getSlug($slug);
        
        if(isset($urlObj->controller) && class_exists($urlObj->controller)) {
            $slugController = new $urlObj->controller;
            if(isset($urlObj->method) && isset($urlObj->arguments) && method_exists($urlObj->controller, $urlObj->method)) {
                $called = $slugController->{$urlObj->method}($urlObj->arguments);
            } elseif(isset($urlObj->method) && !isset($urlObj->arguments) && method_exists($urlObj->controller, $urlObj->method)) {
                $called = $slugController->{$urlObj->method}($this->request);
            } elseif(!isset($urlObj->method) && isset($urlObj->arguments) && method_exists($urlObj->controller, 'show')) {
                $called = $slugController->show($urlObj->arguments);
            } elseif(!isset($urlObj->method) && !isset($urlObj->arguments) && method_exists($urlObj->controller, 'index')) {
                $called = $slugController->index($this->request);
            }
            if(isset($called) && $called!==false) {
                return $called;
            }
        }
        abort('404');
    }    





}
