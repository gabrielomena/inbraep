<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Tasks;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = TasksService::getTasks();
        return response()->json(['data'=> $tasks], 200);
    }
    public function store(TasksRequest $request): JsonResponse
    {
        $task = TasksService::addTask($request->all());
        if(!$task){
            return response()->json(['errors'=> 'Não foi possível criar a tarefa.'], 422);
        }
        return response()->json(['data'=> $task], 200);
    }
    public function update(TasksRequest $request, Tasks $task): JsonResponse
    {
       $task = TasksService::updateTask($request->all(), $task);
        if(!$task){
            return response()->json(['errors'=> 'Não foi possível atualizar a tarefa.'], 422);
        }
        return response()->json(['data'=> $task], 200);
    }
    public function destroy($id): JsonResponse
    {
        $task = TasksService::deleteTask($id);
        if(!$task){
            return response()->json(['errors'=> 'Não foi possível deletar tarefa.'], 422);
        }
        return response()->json(['success'=> 'Tarefa deletada com sucesso!'], 200);
    }
}
