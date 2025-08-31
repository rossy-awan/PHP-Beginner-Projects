<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->latest()->get();
        return view('dashboard', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'team' => 'required|string',
            'progress' => 'required|integer|min:0|max:100',
            'priority' => 'required|in:Low,Medium,High,Urgent',
            'status' => 'required|in:Planned,On Going,Done,Delayed,Canceled',
            'cost' => 'required|numeric|min:0',
        ]);

        Project::create($request->all());
        return redirect()->route('dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'progress' => 'nullable|integer|min:0|max:100',
            'priority' => 'required|in:Low,Medium,High,Urgent',
            'status' => 'required|in:Planned,On Going,Done,Delayed,Canceled'
        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'progress' => $request->progress,
            'priority' => $request->priority,
            'status'   => $request->status,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('dashboard');
    }
}
