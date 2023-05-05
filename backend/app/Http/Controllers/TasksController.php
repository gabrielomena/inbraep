<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Tasks;
use App\Services\TasksService;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = TasksService::getTasks();
        return response()->json(['data'=> $tasks], 200);
    }
    public function store(TasksRequest $request)
    {
        $task = TasksService::addTask($request->all());
        if(!$task){
            return response()->json(['errors'=> 'Não foi possível criar a tarefa.'], 422);
        }
        return response()->json(['data'=> $task], 200);
    }
    public function update(TasksRequest $request, Tasks $task)
    {
       $task = TasksService::updateTask($request->all(), $task);
        if(!$task){
            return response()->json(['errors'=> 'Não foi possível atualizar a tarefa.'], 422);
        }
        return response()->json(['data'=> $task], 200);
    }
    public function destroy($id)
    {
        $task = TasksService::deleteTask($id);
        if(!$task){
            return response()->json(['errors'=> 'Não foi possível deletar tarefa.'], 422);
        }
        return response()->json(['sucess'=> 'Tarefa deletada com sucesso!'], 200);
    }
}
