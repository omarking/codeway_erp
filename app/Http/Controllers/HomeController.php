<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Group;
use App\Models\Holiday;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('id')->simplePaginate(10);

        $projects = Project::with('clas', 'category')->orderBy('id')->simplePaginate(10);

        $tasks = Task::with('type', 'statu', 'priority')->orderBy('id')->simplePaginate(10);

        $holidays = Holiday::with('absence', 'period')->orderBy('id')->simplePaginate(10);

        $groups = Group::orderBy('id')->simplePaginate(10);

        $departaments = Departament::orderBy('id')->simplePaginate(10);

        return view('home', compact('users', 'projects', 'tasks', 'holidays', 'groups', 'departaments'));
    }
}
