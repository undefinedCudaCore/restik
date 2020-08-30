@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Menu List</div>

               <div class="card-body">
                @foreach ($menus as $menu)
                <h4>Dish: {{$menu->title}} - price {{$menu->price}} €</h4>
                <img src="{{asset('images/'.$menu->logo)}}" style="width: 100px; height: auto;" alt="User_logo">
                  <a class="btn btn-dark" style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff;" href="{{route('menu.edit',[$menu])}}" class="list-group-item">Edit</a>
                  <a class="btn btn-dark" style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff;" href="{{route('menu.show',[$menu])}}" class="list-group-item">Show</a>
                  <form method="POST" action="{{route('menu.destroy', [$menu])}}">
                  @csrf
                  <button type="submit" class="btn btn-secondary btn-lg btn-block">Remove</button>
                  </form>
                  <br>
                @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


