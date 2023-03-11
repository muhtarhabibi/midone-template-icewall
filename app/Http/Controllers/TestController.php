<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Http\Controllers;

use App\Models\Test;
use Auth;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the App\Models\test.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tests = Test::query();
        $filter = [];
        if(isset($request->filter)) {
            $filter = $request->filter;
            foreach ($filter as $key => $value) {
                if(!empty($value)) {

                    if( $key == 'sort') {
                        $sort = explode('|', $value);
                        $tests = $tests->orderBy($sort[0], $sort[1]);
                        continue;
                    }

                    // if($key == 'dummy') {

                    // } else {
                        $tests = $tests->where($key, 'like', '%'.$value.'%');
                    // }
                }
            }
        }
        $tests = $tests->orderBy('id')->paginate(1);
        return view('tests.index')
                    ->with('tests', $tests)
                    ->with('filter', $filter);
    }

    /**
     * Show the form for creating a new App\Models\test.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $test = new test;
        // $test->active = 1;
        return view('tests.form')
                    ->with('test', $test);
    }

    /**
     * Store a newly created App\Models\test in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('tests'),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
                $test = new test;
                $test->fill($request->except([]));
                // $test->active = $request->active == 'on';
                $test->save();
                // $test->relations()->sync($request->relations);
                //
            DB::commit();
            $request->session()->flash('status', ['success', 'test berhasil ditambahkan!']);
        } catch(QueryException $ex){
            DB::rollBack();
            $request->session()->flash('status', ['error', 'Gagal untuk menambahkan test. ' . substr($ex->getMessage(), 0, 30)] );
        }

        return redirect()->route('tests.index');
    }

    /**
     * Display the specified App\Models\test.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(test $test)
    {
        //
        return view('tests.show')
                    ->with('test', $test);
    }

    /**
     * Show the form for editing the specified App\Models\test.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(test $test)
    {
        //
        return view('tests.form')
                    ->with('test', $test);
    }

    /**
     * Update the specified App\Models\test in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, test $test)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('tests')->ignore($test->id),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
            $test->fill($request->except([]));
            // $test->active = $request->active == 'on';
            $test->save();
            // $test->relations()->sync($request->relations);
            DB::commit();
            $request->session()->flash('status', ['success', 'test berhasil diubah!']);
        } catch(QueryException $ex){
            DB::rollBack();
            $request->session()->flash('status', ['error', 'Gagal untuk mengubah test. ' . substr($ex->getMessage(), 0, 30)] );
        }

        return redirect()->route('tests.index');
    }

    /**
     * Remove the specified App\Models\test from storage.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(test $test, Request $request)
    {
        try {
            //
            $test->delete();
            $request->session()->flash('status', ['success', 'test berhasil dihapus!']);
        } catch(QueryException $ex){
            $request->session()->flash('status', ['error', 'Gagal untuk menghapus test. ' . substr($ex->getMessage(), 0, 30)] );
        }

        return redirect()->route('tests.index');
    }
}
