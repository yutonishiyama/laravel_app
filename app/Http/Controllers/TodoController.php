<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $instanceClass)
    {
        $this->middleware('auth');
        $this->todo = $instanceClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($this->todo->find(1));
        $todos = $this->todo->getByUserId(Auth::id());
        // SQL!!
        // dd(compact('todos'));
        // dd($todos);
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $input = $request->all();
        $input['user_id'] = Auth::id();
        // $input['user'] = 'にしやま';
        // dd($input);
        $this->todo->fill($input)->save();
        // SQL!!
        // $this->todo->title = 'fooo';
        // $this->todo->save();
        return redirect()->to('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id);
        // SQL!! ID 1
        // dd(compact('todo'));
        // dd($this->todo->find($id));
        return view('todo.edit',compact('todo'));
        // $array = array ("todo" => $todo);
        // return view('todo.edit', $array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        // dd($request);
        // dd($this->todo);
        // dd($this->todo->find($id));
        // dd($this->todo->find($id)->fill($input));
        $this->todo->find($id)->fill($input)->save();
        // SQL!! ID 1
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();
        // SQL!! ID 1
        return redirect()->to('todo');
    }
}
