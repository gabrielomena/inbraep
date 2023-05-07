<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Task;
use App\Services\TasksService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    protected $taskService;

    public function __construct(TasksService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getTasks();
        return response()->json(['data'=> $tasks], 200);
    }
    public function store(TasksRequest $request): JsonResponse
    {
        try {
            $task = $this->taskService->addTask($request->all());
            if(!$task['status']){
                return response()->json(['errors'=> 'Não foi possível criar a tarefa.'], 422);
            }
            return response()->json(['data'=> $task['data']], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['errors'=> $e->getMessage()], 422);
        }

    }
    public function update(TasksRequest $request, Task $task): JsonResponse
    {
        try {
            $task = $this->taskService->updateTask($request->all(),$task);
            if(!$task['status']){
                return response()->json(['errors'=> 'Não foi possível atualizar a tarefa.'], 422);
            }
            return response()->json(['data'=> $task], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['errors'=>$e->getMessage()], 422);
        }

    }
    public function destroy($id): JsonResponse
    {
        try {
            $result = $this->taskService->deleteTask($id);
            if(!$result['status']){
                return response()->json(['errors'=> 'Não foi possível deletar tarefa.'], 422);
            }
            return response()->json(['success'=> 'Tarefa deletada com sucesso!'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['errors'=> $e->getMessage()], 422);
        }

    }
}
