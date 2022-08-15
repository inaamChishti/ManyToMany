@extends('layouts.app')

@section('content')

<form method="post" action="{{url('role_store')}}">
	@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Role Name</label>
    <input type="text" class="form-control" id="" name="role_name" placeholder="Enter Role Name">

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr><hr>
<form method="post" action="{{url('assign_role')}}">
  <h1>Attach Role with users</h1>
  @csrf
  <div class="form-group">
    <input type="text" name="name" placeholder="enter name">
    <input type="email" name="name" placeholder="enter email">


      <select multiple="multiple" name="role_name[]" id="user_name" style="align-items: center;"> 
       <option> Select roles</option>
       
          @if(sizeof($roles)>0)
           @foreach($roles as $role)
              
             <option value="{{ $role->id }}" > {{ $role->role_name }}</option>
             
          
           @endforeach
           @endif
      </select>

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr><hr>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User Name</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	@if(sizeof($user)>0)
  	@foreach($user as $role_names)
    <tr>
      <th scope="row">{{$role_names->id}}</th>
      <td>{{$role_names->name}}</td>
      <td>
      @foreach($role_names->roles as $role)
      {{$role->role_name}},
      @endforeach
      </td>
      <td><a href="{{url('edit_record/'.$role_names->id)}}">edit</a></td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
@endsection