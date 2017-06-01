<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Status;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        
        return view('tasks.index')
            ->with('action_name', 'Listagem')
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create')
            ->with('action_name', 'Adicionar nova atividade')
            ->with('status', Status::pluck('status','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();

        $input = $request->all();

        if (!$task->validate($input)) {
            return redirect()->back()
                ->with('errors', $task->errors())
                ->withInput();
        }

        $input = $request->all();

        Task::create($input);

        return redirect()->back()->with('status', 'Atividade adicionada com sucesso.');;
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
        $task = Task::findOrFail($id);

        return view('tasks.edit')
            ->with('action_name', 'Editar')
            ->with('task', $task)
            ->with('status', Status::pluck('status','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $input = $request->all();

        if (!$task->validate($input)) {
            return redirect()->back()
                ->with('errors', $task->errors())
                ->withInput();
        }

        $task->fill($input)->save();    

        return redirect()->back()->with('status', 'Atividade alterada com sucesso.');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
