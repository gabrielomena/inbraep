<?php

namespace App\Services;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TasksService{
    public function getTasks (): Object
    {
        return Task::all();
    }
    public function addTask(Array $task): array
    {
        try {
            DB::beginTransaction();
            $task = Task::create($task);
            DB::commit();
            return [
                'data' => $task,
                'status' => true
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return [
                'error' => $e->getMessage(),
                'status' => false
            ];
        }
    }

    public function updateTask(Array $data, Task $task): array
    {
        try {
            DB::beginTransaction();
            $task->update($data);
            $task->save();
            DB::commit();
            return [
                'data' => $task,
                'status' => true
            ];
        } catch(Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return [
                'error' => $e->getMessage(),
                'status' => false
            ];
        }
    }

    public function deleteTask(int $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::findOrFail($id);
            $task->delete();
            DB::commit();
            return [
                'data' => 'Tarefa deletada com sucesso!',
                'status' => true
            ];
        } catch(Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return [
                'error' => $e->getMessage(),
                'status' => false
            ];
        }
    }
}
