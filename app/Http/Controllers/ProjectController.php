<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('Components.User.showallproject.showallproject', compact('projects'));
    }

    
    //public function indexContent(){
    //    $projects = Project::all();
    //    return view('Components.Admin.blog.projects.projects_content', compact('projects'));
    //}
}