<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * The view where to find the resources
     *
     * @var string
     */
    protected $view = '';

    /**
     * The name of the route for the resource
     *
     * @var string
     */
    protected $route = '';

    /**
     * @var Model
     */
    protected $model = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('campaign');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->crudIndex();
    }
    public function crudIndex()
    {
        $model = new $this->model;
        $name = $this->view;
        $models = $model
            ->search(request()
                ->get('search'))
            ->order(request()->get('order'))
            ->paginate();
        return view('cruds.index', compact('models', 'name', 'model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->crudCreate();
    }
    public function crudCreate()
    {
        $this->authorize('create', $this->model);

        return view('cruds.create', ['name' => $this->view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crudStore(Request $request)
    {
        $this->authorize('create', $this->model);

        $model = new $this->model;
        $model->create($request->all());
        if ($request->has('submit-new')) {
            return redirect()->route($this->route . '.create')
                ->with('success', trans($this->view . '.create.success'));
        }
        return redirect()->route($this->route . '.index')->with('success', trans($this->view . '.create.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function crudShow(Model $model)
    {
        $this->authorize('view', $model);
        $name = $this->view;

        return view('cruds.show', compact('model', 'name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function crudEdit(Model $model)
    {
        $this->authorize('update', $model);
        $name = $this->view;

        return view('cruds.edit', compact('model', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function crudUpdate(Request $request, Model $model)
    {
        $this->authorize('update', $model);

        $model->update($request->all());
        if ($request->has('submit-new')) {
            return redirect()->route($this->route . '.create')
                ->with('success', trans($this->view . '.edit.success'));
        }
        return redirect()->route($this->route . '.show', $model->id)
            ->with('success', trans($this->view . '.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function crudDestroy(Model $model)
    {
        $this->authorize('delete', $model);

        $model->delete();
        return redirect()->route($this->route . '.index')->with('success', trans($this->view . '.destroy.success'));
    }
}