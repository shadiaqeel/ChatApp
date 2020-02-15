@extends('layouts.app')

@section('content')
<div class="container-fluid chatbackground"  >
  <div class=" card bg-light " >

  <chat-app :user="{{auth()->user()}}" ></chat-app>
  </div>
    
</div>
@endsection
