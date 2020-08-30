@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">New Dish</div>

               <div class="card-body">
                    <form method="POST" action="{{route('menu.store')}}" enctype="multipart/form-data">
                        <label>Title</label>
                        <input type="text" name="menu_title" class="form-control" value="{{old('menu_title')}}">
                        <label>Price €</label>
                        <input type="text" name="menu_price" class="form-control" value="{{old('menu_price')}}">
                        <label>Weight (g)</label>
                        <input type="text" name="menu_weight" class="form-control" value="{{old('menu_weight')}}">
                        <label>Meat (g)</label>
                        <input type="text" name="menu_meat" class="form-control" value="{{old('menu_meat')}}">
                        <label>About</label>
                        <textarea style="margin-bottom: 15px;" name="menu_about" class="form-control" id="summernote"  value="{{old('menu_about')}}"></textarea>
                        <label>Image</label>
                        <input type="file" class="form-control" name="menu_logo">
                        <small class="form-text text-muted">Press "Create" button to add menu.</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Create</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>
@endsection
