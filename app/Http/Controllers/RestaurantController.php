<?php

namespace App\Http\Controllers;

use Validator;
use App\Menu;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
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
        $menus = Menu::all();
        $selectId = 0;
        $sort = '';

        if ($request->menu_id) {

            if ($request->sort) {
                if ($request->sort == 'title') {
                    $restaurants = Restaurant::where('menu_id', $request->menu_id)->orderBy('title')->get();
                    $sort = 'title';
                } elseif ($request->sort == 'customers') {
                    $restaurants = Restaurant::where('menu_id', $request->menu_id)->orderBy('customers')->get();
                    $sort = 'customers';
                } else {
                    $restaurants = Restaurant::all();
                }
            } else {
                $restaurants = Restaurant::where('menu_id', $request->menu_id)->get();
            }

            $selectId = $request->menu_id;
        } else {
            
            if ($request->sort) {
                if ($request->sort == 'title') {
                    $restaurants = Restaurant::orderBy('title')->get();
                    $sort = 'title';
                } elseif ($request->sort == 'customers') {
                    $restaurants = Restaurant::orderBy('customers')->get();
                    $sort = 'customers';
                } else {
                    $restaurants = Restaurant::all();
                }
            } else {
                $restaurants = Restaurant::all();
            }
        }
        return view('restaurant.index', compact('restaurants','menus', 'selectId', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('title')->get();
        return view('restaurant.create', ['menus' => $menus]);
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
            'restaurant_title' => ['required', 'min:3', 'max:64'],
            'restaurant_customers' => ['required', 'integer'],
            'restaurant_employees' => ['required', 'integer'],
            'menu_id' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $restaurant = new Restaurant;
        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;
        $restaurant->logo = '';
        
        if ($request->hasFile('restaurant_logo')) {
            $image = $request->file('restaurant_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $restaurant->logo = $name;
        }

        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurant.show', ['restaurant' => $restaurant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $menus = Menu::orderBy('title')->get();
        return view('restaurant.edit', ['restaurant' => $restaurant, 'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(),
        [
            'restaurant_title' => ['required', 'min:3', 'max:64'],
            'restaurant_customers' => ['required', 'integer'],
            'restaurant_employees' => ['required', 'integer'],
            'menu_id' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;
        $restaurant->logo = '';
        
        if ($request->hasFile('restaurant_logo')) {
            $image = $request->file('restaurant_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $restaurant->logo = $name;
        }

        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
