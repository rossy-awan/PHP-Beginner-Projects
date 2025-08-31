@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-bold mb-8 text-center">🛠️ Project Management</h2>

<!-- Add Project Form -->
<form action="{{ route('projects.store') }}" method="POST" class="mb-12 grid grid-cols-1 gap-4 md:grid-cols-2 text-lg">
    @csrf
    <!-- Project Name - Full Width -->
    <input type="text" name="name" placeholder="Project name" class="md:col-span-2 p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] placeholder-[#888] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
    
    <!-- Description - Full Width -->
    <textarea name="description" placeholder="Description" class="md:col-span-2 p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] placeholder-[#888] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required></textarea>
    
    <!-- Deadline -->
    <input type="date" name="deadline" class="p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
    
    <!-- Team -->
    <input type="text" name="team" placeholder="Team (comma separated)" class="p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] placeholder-[#888] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
    
    <!-- Progress -->
    <input type="number" name="progress" placeholder="Progress (%)" min="0" max="100" class="p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] placeholder-[#888] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
    
    <!-- Priority -->
    <select name="priority" class="p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
        <option value="Urgent">Urgent</option>
    </select>

    <!-- Status -->
    <select name="status"  class="p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
        <option value="Planned">Planned</option>
        <option value="On Going">On Going</option>
        <option value="Done">Done</option>
        <option value="Delayed">Delayed</option>
        <option value="Canceled">Canceled</option>
    </select>

    <!-- Cost -->
    <input type="number" name="cost" step="0.01" placeholder="Cost (Rp)" class="p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] placeholder-[#888] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
    
    <!-- Submit Button - Full Width -->
    <button type="submit" class="md:col-span-2 bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded text-black font-semibold">
        Add Project
    </button>
</form>

<!-- Projects List -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($projects as $project)
    <div class="bg-[#1e1e1e] p-4 rounded-xl shadow space-y-2 border-t-4 border-yellow-500">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">{{ $project->name }}</h3>
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="font-semibold text-lg text-red-500 hover:text-red-700">✕</button>
            </form>
        </div>
        <p class="text-[#a7a7a7] text-lg">{{ $project->description ?? 'No description' }}</p>
        <p class="text-lg">Deadline: <span class="text-[#d5d5d5]">{{ $project->deadline ?? '-' }}</span></p>
        <p class="text-lg">Team: <span class="text-[#d5d5d5]">{{ $project->team ?? '-' }}</span></p>
        <p class="text-lg">Cost: <span class="text-[#d5d5d5]">Rp {{ number_format($project->cost, 2, ',', '.') }}</span></p>

        <!-- Form Update Progress, Priority, Status -->
        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-2">
            @csrf
            @method('PUT')

            <!-- Progress -->
            <div class="flex items-center text-lg gap-1">
                <span class="whitespace-nowrap">Progress:</span>
                <input type="number" name="progress" value="{{ $project->progress }}" min="0" max="100" class="flex-1 rounded bg-[#1e1e1e] text-[#f4f4f4] focus:outline-none">
            </div>

            <!-- Priority -->
            <div class="flex items-center text-lg gap-1">
                <span class="whitespace-nowrap">Priority:</span>
                <select name="priority" class="flex-1 rounded bg-[#1e1e1e] text-[#f4f4f4] focus:outline-none">
                    <option value="Low" {{ $project->priority == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ $project->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ $project->priority == 'High' ? 'selected' : '' }}>High</option>
                    <option value="Urgent" {{ $project->priority == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>

            <!-- Status -->
            <div class="flex items-center text-lg gap-1">
                <span class="whitespace-nowrap">Status:</span>
                <select name="status" class="flex-1 rounded bg-[#1e1e1e] text-[#f4f4f4] focus:outline-none">
                    <option value="Planned" {{ $project->status == 'Planned' ? 'selected' : '' }}>Planned</option>
                    <option value="On Going" {{ $project->status == 'On Going' ? 'selected' : '' }}>On Going</option>
                    <option value="Done" {{ $project->status == 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Delayed" {{ $project->status == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                    <option value="Canceled" {{ $project->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded text-black font-semibold">
                Update
            </button>
        </form>

        <!-- Tasks -->
        <ul class="mt-2">
            @foreach($project->tasks as $task)
            <li class="flex justify-between text-lg py-1">
                <span>{{ $task->title }}</span>
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="bg-[#2a2a2a] text-[#f4f4f4] rounded p-1 border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500">
                        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                        <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </form>
            </li>
            @endforeach
        </ul>

        <!-- Add Task -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <input name="title" placeholder="New task" class="w-full p-2 rounded bg-[#2a2a2a] text-[#f4f4f4] placeholder-[#888] border border-[#2a2a2a] focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500" required>
        </form>
    </div>
    @empty
    <p class="text-[#727272]">No projects yet.</p>
    @endforelse
</div>

@endsection