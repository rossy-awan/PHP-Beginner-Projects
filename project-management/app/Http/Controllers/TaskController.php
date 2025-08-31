<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string',
            'status' => 'required|in:todo,in-progress,done'
        ]);
        Task::create($request->only('project_id', 'title', 'status'));
        return redirect()->route('dashboard');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:todo,in-progress,done',
        ]);
        $task->update($request->only('title', 'status'));
        return redirect()->route('dashboard');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard');
    }
}