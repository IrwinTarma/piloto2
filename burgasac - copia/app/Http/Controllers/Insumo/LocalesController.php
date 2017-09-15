<?php

namespace App\Http\Controllers\Insumo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Locale;
use Illuminate\Http\Request;
use Session;

class LocalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $locales = Locale::paginate(25);

        return view('locales.index', compact('locales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('locales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        $this->validate($request, [
            'nombre'       => 'required',
        ]);
        
        Locale::create($requestData);

        Session::flash('flash_message', 'Locale added!');

        return redirect('local/locales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $locale = Locale::findOrFail($id);

        return view('locales.show', compact('locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $locale = Locale::findOrFail($id);

        return view('locales.edit', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $locale = Locale::findOrFail($id);
        $locale->update($requestData);

        Session::flash('flash_message', 'Locale updated!');

        return redirect('local/locales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Locale::destroy($id);

        Session::flash('flash_message', 'Locale deleted!');

        return redirect('local/locales');
    }
}
