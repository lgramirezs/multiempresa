<?php

namespace App\Http\Controllers\Tenancy;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tenancy.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenancy.task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|image',
        ]);

        $data['image_url'] = Storage::put('tasks', $request->file('image_url'));

        Task::create($data);

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tenancy.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tenancy.task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image',
        ]);

        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($task->image_url) {
                Storage::delete($task->image_url);
            }
            $data['image_url'] = Storage::put('tasks', $request->file('image_url'));
        } else {
            $data['image_url'] = $task->image_url; // Keep the old image if not updated
        }

        $task->update($data);

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the image file if it exists
        if ($task->image_url) {
            Storage::delete($task->image_url);
        }
        // Delete the task record
        $task->delete();
        return redirect()->route('task.index');
    }
}
