@extends('master')

@section('title')
    Segments
@endsection

@section('content')
    <div class="content p-4">
        <h4 class="text-center pb-4">Add New Segments</h4>
        <span class="text-success">{{ Session::get('message')}}</span>
        <form class="" action="{{ route('segment-add') }}" method="post" onsubmit="return submitNullCheck()">
            {{ csrf_field() }}
            <div class="row border-bottom mb-4 pt-4 border-top">
                <label class="col-sm-3 col-form-label">Segment Name</label>
                <div class="pb-4 col-sm-9">
                    <input required type="text" name="name" class="form-control" placeholder="Enter Segment Name">
                    <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
                </div>
            </div>
            <div class="row border-bottom mb-4">
                <label for="staticEmail" class="col-sm-3 col-form-label">Segment Logic</label>
                <div class="col-sm-9">
                    <div class="" id="segment-logic-fields">

                    </div>
                    <div class="pt-4 pb-4 pl-1">
                        <button type="button" class="btn btn-primary btn-sm" id="addDateLogic"><i class="fas fa-plus"></i> ADD Date Logic</button>
                        <button type="button" class="btn btn-info btn-sm" id="addTextLogic"><i class="fas fa-plus"></i> ADD Text Logic</button>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>

        </form>
        <div class="pt-4 pb-4 pl-1">
            <a href="{{ route('subscribers') }}" class="btn btn-outline-primary btn-sm">Show Subscribers</a>
            <a href="{{ route('subscriber-add') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-plus"></i> ADD Subscriber</a>
        </div>
        <div>
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Logics</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 1 )
                @foreach($segments as $segment)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $segment->name }}</td>
                    <td>{{ count($segment->segmentLogic) }}</td>
                    <td><a href="{{ route('show-data',['target_segment'=>$segment->id]) }}" class="btn btn-sm btn-outline-dark">Show Data</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
