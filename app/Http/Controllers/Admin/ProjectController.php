<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Admin\Project;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('title')) {

            $projects = Project::where('title', 'like', "%$request->title%")->get();
        } else {
            $projects = Project::all();
        }
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin\projects\crate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $formData = $request->all();
        $newProject = new Project();
        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->title, '-');
        $newProject->save();
        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $formData = $request->all();
        $this->validation($request);
        $project->slug = Str::slug($project->title, '-');
        $project->update($formData);
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validation($request)
    {

        $formData = $request->all();

        $validator = Validator::make($formData, [
            'title' => 'required|max:200',
            'description' => 'required',
            'thumb' => 'required',

        ], [
            'title.required' => 'Il titolo deve essere inserito',
            'title.max' => 'Il titolo deve avere :max caratteri',
            'description.required' => 'La descrizione deve essere inserita',
            'thumb.required' => 'Questo campo non può rimanere vuoto',

        ])->validate();

        return $validator;
    }
}
