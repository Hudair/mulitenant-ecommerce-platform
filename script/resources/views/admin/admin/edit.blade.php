@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endpush
@section('content')
<div class="row">
	<div class="col-lg-9">      
		<div class="card">
			<div class="card-body">
				<h4>{{ __('Edit Admin') }}</h4>
				<form method="post" action="{{ route('admin.users.update',$user->id) }}" class="basicform">
                    @csrf
                    @method('PUT')
					<div class="pt-20">
						@php
						$arr['title']= 'Name';
						$arr['id']= 'name';
						$arr['type']= 'text';
						$arr['placeholder']= 'Enter Name';
						$arr['name']= 'name';
                        $arr['is_required'] = true;
                        $arr['value']=$user->name;
						echo  input($arr);
                      
						$arr['title']= 'Email';
						$arr['id']= 'email';
						$arr['type']= 'email';
						$arr['placeholder']= 'Enter Email';
						$arr['name']= 'email';
                        $arr['is_required'] = true;
                        $arr['value']=$user->email;
                        echo  input($arr);
                        
                        $arr['title']= 'Password';
						$arr['id']= 'password';
						$arr['type']= 'password';
						$arr['placeholder']= 'Enter password';
						$arr['name']= 'password';
						$arr['is_required'] = true;
                        echo  input($arr);
                        
                        $arr['title']= 'Password';
						$arr['id']= 'password_confirmation';
						$arr['type']= 'password';
						$arr['placeholder']= 'Confirm Password';
						$arr['name']= 'password_confirmation';
						$arr['is_required'] = true;
						echo  input($arr);
                        @endphp
                        <div class="form-group">
                            <label for="roles">{{ __('Assign Roles') }}</label>
                                <select required name="roles[]" id="roles" class="form-control select2" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" @if($user->status==1) selected @endif>Active</option>
                            <option value="0"  @if($user->status==0) selected @endif>Deactive</option>

                        </select>
                        </div>
                        
						
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-3">
			<div class="single-area">
				<div class="card">
					<div class="card-body">
						<h5>{{ __('Publish') }}</h5>
						<hr>
						<div class="btn-publish">
							<button type="submit" class="btn btn-primary col-12 basicbtn"><i class="fa fa-save"></i> {{ __('Save') }}</button>
						</div>
					</div>
				</div>
			</div>
			
	</div>


</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush