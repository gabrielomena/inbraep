<?php

namespace App\Services;
use App\Models\Tasks;
use Illuminate\Support\Facades\DB;

class TasksService{
    public static function getTasks()
    {
        return Tasks::all();
    }

    public static function addTask($task)
    {
        try {
            DB::beginTransaction();
            $response = Tasks::create($task);
            DB::commit();
            return $response;
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public static function updateTask($data, $task)
    {
        try {
            DB::beginTransaction();
            $task->update($data);
            $task->save();
            DB::commit();
            return $task;
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public static function deleteTask($id)
    {
        try {
            DB::beginTransaction();
            $task = Tasks::findOrFail($id);
            $task->delete();
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }
}
