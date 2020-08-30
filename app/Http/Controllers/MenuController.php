<?php

namespace App\Http\Controllers;

use Validator;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = Menu::orderBy('price')->get();

        return view('menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),
        [
            'menu_title' => ['required', 'min:3', 'max:200'],
            'menu_price' => ['required'],
            'menu_weight' => ['required', 'integer'],
            'menu_meat' => ['required', 'integer'],
            'menu_about' => ['required', 'min:3', 'max:200']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $menu = new Menu;
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;

        if ($request->menu_meat > $request->menu_weight) {
            return redirect()->route('menu.create')->with('info_message', 'Mesos kiekis negali buti didesnis uz patiekalo svori.');
        }

        $menu->about = $request->menu_about;
        $menu->logo = '';

        if ($request->hasFile('menu_logo')) {
            $image = $request->file('menu_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $menu->logo = $name;
        }
        
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu.show', ['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        
        $validator = Validator::make($request->all(),
        [
            'menu_title' => ['required', 'min:3', 'max:200'],
            'menu_price' => ['required'],
            'menu_weight' => ['required', 'integer'],
            'menu_meat' => ['required', 'integer'],
            'menu_about' => ['required', 'min:3', 'max:200']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;

        if ($request->menu_meat > $request->menu_weight) {
            return redirect()->route('menu.create')->with('info_message', 'Mesos kiekis negali buti didesnis uz patiekalo svori.');
        }

        $menu->about = $request->menu_about;
        $menu->logo = '';
        
        if ($request->hasFile('menu_logo')) {
            $image = $request->file('menu_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $menu->logo = $name;
        }
        
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if($menu->menuRestaurants->count()){
            return redirect()->route('menu.index')->with('info_message', 'Trinti negalima, nes turi priskirų restoranų.');
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
