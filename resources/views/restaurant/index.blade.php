@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                <div class="title">Restoranų sąrašas</div>
                <form action="{{route('restaurant.index')}}" method="get">
                  <select name="menu_id" class="form-control form-control-sm">
                      <option value="0">Parodyti visus</option>
                      @foreach ($menus as $menu)
                          <option value="{{$menu->id}}" @if ($selectId == $menu->id) selected @endif>{{$menu->title}} {{$menu->price}} eur</option>
                      @endforeach
                  </select>
                  <label>Rušiuoti pagal: </label>
                  <ul class="list-group">
                    Pavadinimą: <input type="radio" name="sort" value="title" @if ('title' == $sort) checked @endif>
                    Pirkėją: <input type="radio" name="sort" value="customers" @if ('customers' == $sort) checked @endif>
                    <button type="submit" class="btn btn-success">Rušiuoti</button>
                    <a href="{{route('restaurant.index')}}" class="btn btn-outline-primary">Nunulinti</a>
                  </ul>
              </form>
               </div>

               <div class="card-body">
                @if ($selectId != $menu->id)
                  @foreach ($restaurants as $restaurant)
                    <p style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: black;" href="{{route('restaurant.edit',[$restaurant])}}"  class="list-group-item">RESTORANAS: {{$restaurant->title}} <img src="{{asset('images/'.$restaurant->logo)}}" style="width: 200px; height: auto;" alt="User_logo"></p>
                    <p style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: black;" href="{{route('restaurant.edit',[$restaurant])}}"  class="list-group-item">Dienos patiekalas: {{$restaurant->restaurantMenu->title}}</p>
                    <p style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: black;" href="{{route('restaurant.edit',[$restaurant])}}"  class="list-group-item">Kaina: {{$restaurant->restaurantMenu->price}}</p>
                    <img src="{{asset('images/'.$restaurant->restaurantMenu->logo)}}" style="width: 200px; height: auto;" alt="Dish_logo">
                    <a class="btn btn-secondary btn-lg btn-block" href="{{route('restaurant.edit',[$restaurant])}}">Redaguoti</a>
                    <a class="btn btn-secondary btn-lg btn-block" href="{{route('restaurant.show',[$restaurant])}}">Peržiūrėti</a><br>
    
                    <form method="POST" action="{{route('restaurant.destroy', [$restaurant])}}">
                      @csrf
                      <button type="submit" class="btn btn-secondary btn-lg btn-block">Ištrinti</button>
                    </form>
                    <br>
                  @endforeach
                @else
                  <h2>Sąrašas tuščias</h2>
                @endif
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
