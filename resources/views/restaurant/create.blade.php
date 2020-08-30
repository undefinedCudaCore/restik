@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">New restaurant</div>

               <div class="card-body">
                    <form method="POST" action="{{route('restaurant.store')}}" enctype="multipart/form-data">
                        <label>Pavadinimas</label>
                        <input type="text" name="restaurant_title" class="form-control" value="{{old('restaurant_title')}}">
                        <label>Pirkėjai</label>
                        <input type="text" name="restaurant_customers" class="form-control" value="{{old('restaurant_customers')}}">
                        <label>Darbuotojai</label>
                        <input type="text" name="restaurant_employees" class="form-control" value="{{old('restaurant_employees')}}">
                        <label>Paveiksliukas</label>
                        <input type="file" class="form-control" name="restaurant_logo">
                        <select style="margin-bottom: 15px;" name="menu_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->title}} {{$menu->weight}} (g)</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Press "Create" button to add restaurant.</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Create</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

