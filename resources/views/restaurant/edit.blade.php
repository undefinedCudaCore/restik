@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Edit restaurant</div>

               <div class="card-body">
                    <form method="POST" action="{{route('restaurant.update',[$restaurant])}}" enctype="multipart/form-data">
                        <label>Title</label>
                        <input type="text" name="restaurant_title" value="{{old('restaurant_title', $restaurant->title)}}" class="form-control">
                        <label>Customers</label>
                        <input type="text" name="restaurant_customers" value="{{old('restaurant_customers', $restaurant->customers)}}" class="form-control">
                        <label>Employees</label>
                        <input type="text" name="restaurant_employees" value="{{old('restaurant_employees', $restaurant->employees)}}" class="form-control">
                        <label>Paveiksliukas</label>
                        <input type="file" class="form-control" name="restaurant_logo">
                        <select style="margin-bottom: 15px;" name="menu_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($menus as $menu)
                                <option value="{{$menu->id}}" @if($menu->id == $restaurant->menu_id) selected @endif>
                                    {{$menu->title}} {{$menu->weight}} (g)
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Press "Change" button to save changes to restaurant.</small>
                        @csrf
                        <button type="submit"  class="btn btn-secondary btn-lg btn-block">Change</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

