@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
            <div class="card-header p-3 bg-secondary text-white">Restoranas</div>

               <div class="card-body">
               <div class="card-body shadow p-3 bg-white rounded">
                    <label>Restoranas</label>
                    <h4>{{$restaurant->title}}.</h4>
                    <label>Max klientu</label>
                    <h4>{{$restaurant->customers}}</h4>
                    <label>Dirba siuo metu</label>
                    <h4>{{$restaurant->employees}}</h4>
               </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection