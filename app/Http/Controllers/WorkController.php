<?php

namespace App\Http\Controllers;
use Request;
use App\Http\Requests\CreateWorkRequest;
use App\Work;
use Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $length = Work::where('user_id', Auth::user()->id)->get();
        $length = count($length);
        $page = Work::where('user_id', Auth::user()->id)->orderBy('id', 'user_id')->paginate(10);
        return view('coming', compact('page', 'length'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        Work::create(Request::all());
        return redirect('coming');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work = Work::findOrFail($id);
        return view('show')->with('work', $work);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Work::findOrFail($id);
        return view('edit')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CreateWorkRequest $request)
    {
        $work = Work::findOrFail($id);
        $title = Request::all('user');
        $create = $request->created_at;
        $update = $request->updated_at;

        //tutaj dodaję godzinę +1 do serwera żeby z lokalem się zgadzała
        $now = new \DateTime();
        $now->modify('+ 1 hour');
        ($update == null) ? $work->update(['updated_at' => $now]) :  $work->update(['updated_at' => $update]);
        $work->update($title);
        $work->update(['created_at' => $create]);
        return redirect('coming');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Work::findOrFail($id)->delete();
        return redirect('coming');
    }
}
