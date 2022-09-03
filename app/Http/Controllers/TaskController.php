<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data["tasks"] = Task::where('created_by', Auth::id())->get();
        return view('tasks.index');
    }

    public function list()
    {
        return DataTables::of(Task::with("category")->where('created_by', Auth::id()))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view("tasks.action",compact("row"));
            })
            ->addColumn('status_name', function ($row){
                return StatusType::getDescription($row->status);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_list = CategoryService::GetUserCategoryList();;
        $status_list = StatusType::asSelectArray();
        return view("tasks.create", compact('category_list', 'status_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->category_id = $request->category_id;
        $task->status = $request->status;
        $task->deadline = $request->deadline;
        // $task->created_by = Auth::id();
        $task->owner()->associate(Auth::user());
        $task->save();

        return redirect("/tasks");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::where('created_by', Auth::id())->find($id);
        if (!$task) {
            return redirect('/tasks');
        }
        $category_list = CategoryService::GetUserCategoryList();;
        $status_list = StatusType::asSelectArray();
        return view("tasks.edit", compact('task', 'category_list', 'status_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {

        $task = Task::where('created_by', Auth::id())->find($id);
        if ($task) {
            $task->title = $request->title;
            $task->description = $request->description;
            $task->category_id = $request->category_id;
            $task->status = $request->status;
            $task->deadline = $request->deadline;
            $task->save();
        }

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('created_by', Auth::id())->find($id);
        if ($task) {
            $task->delete();
        }
        return redirect('/tasks');
    }
}