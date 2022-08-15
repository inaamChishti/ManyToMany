@extends('layouts.app')

@section('content')
<form action="{{url('update_role')}}" method="POST" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    		<input type="text" name="name" value="{{$user->name}}" >
    		<input type="hidden" name="user_id" value="{{ $user->id}}">
            <select multiple="multiple" name="roles[]" id="sports" style="align-items: center;"> 
			 <option value="" > Select Role</option>
			 

			     @foreach($roles as $key => $role)
			    		
			       <option value="{{ $role->id }}"  {{$selected_roles->contains($role->id) ? 'selected' : ''}}> {{ $role->role_name }}</option>
			       
			    
			     @endforeach
			</select>
        <button type="submit">Save</button>

</form>
@endsection