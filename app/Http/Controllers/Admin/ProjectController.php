<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin\projects\crate', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $this->validation($formData);
        $newProject = new Project();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('cartella', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->title, '-');
        $newProject->save();

        if (array_key_exists('technologies', $formData)) {
            // la funzione sync() ci permette di sincronizzare i tag selezionati nel form con quelli presenti nella tabella ponte
            $newProject->technologies()->attach($formData['technologies']);
        }

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
        $categories = Category::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
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
        $this->validation($formData);
        $project->slug = Str::slug($formData['title'], '-');
        $project->update($formData);

        if (array_key_exists('technologies', $formData)) {
            // la funzione sync() ci permette di sincronizzare i tag selezionati nel form con quelli presenti nella tabella ponte
            $project->technologies()->sync($formData['technologies']);
        } else {
            // dobbiamo specificare che se non è stato selezionato alcun tag, deve eliminare tutti i suoi riferimenti dalla tabella ponte
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
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

    private function validation($formData)
    {

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
