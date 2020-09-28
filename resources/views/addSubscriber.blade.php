@extends('master')

@section('title')
    Segments
@endsection

@section('content')
    <div class="content p-4">
        <h4 class="text-center pb-4">Add New Subscriber</h4>
        <span class="text-success">{{ Session::get('message')}}</span>
        <form class="" action="{{ route('subscriber-add-action') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="pb-4 col-sm-9">
                    <input required type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                    <span class="text-danger">{{ $errors->has('first_name')? $errors->first('first_name') : '' }}</span>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="pb-4 col-sm-9">
                    <input required type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                    <span class="text-danger">{{ $errors->has('last_name')? $errors->first('last_name') : '' }}</span>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="pb-4 col-sm-9">
                    <input required type="email" name="email" class="form-control" placeholder="Enter Email">
                    <span class="text-danger">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">Birth day</label>
                <div class="pb-4 col-sm-9">
                    <input required name="birth_day" type="date" class="form-control">
                    <span class="text-danger">{{ $errors->has('birth_day')? $errors->first('birth_day') : '' }}</span>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
                <a href="{{ route('/') }}" class="btn btn-dark btn-sm">Back</a>
            </div>

        </form>

    </div>

@endsection
