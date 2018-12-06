<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Breadcrumbs;

class BaseController extends Controller
{
    public function __construct(){
    $breadcrumbs = new Breadcrumbs;
    $breadcrumbs::setCssClasses('breadcrumb');
    $breadcrumbs::setListElement('ul');
	}
}
