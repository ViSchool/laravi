<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Subject;
use App\Topic;
use App\Unit;
use App\Content;
use App\Status;
use Auth;
use App\Mistake;


class BackendController extends Controller
{
    public function __construct() 
    {
     	$this->middleware('auth:admin');
     }
    
    public function index() 
    {
		$admin = Auth::guard('admin')->user();
		$mistakes = Mistake::admin_mistake();
		$nrSubjects = Subject::all()->count();
    	$nrTopics = Topic::all()->count();
    	$nrContents = Content::all()->count();
		$nrUnits = Unit::all()->count();
		return view('backend.vischool_backend', compact('admin','mistakes','nrSubjects','nrTopics','nrContents','nrUnits'));
	}
    
    public function admin_subjects() {
	return view('backend.admin_subjects', compact('subjects'));
	}
	
	public function approvals()
	{
		$status = Status::find(2);
		return view('backend.index_approvals',compact('status'));
	}
	
}
