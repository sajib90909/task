@extends('master')

@section('title')
    Segments
@endsection

@section('content')
    <div class="content p-4">
        <h4 class="text-center pb-4">Segment logic wise data show</h4>
        <div>
            <h6>logic</h6>
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action type</th>
                    <th scope="col">Action Column</th>
                    <th scope="col">Logic Name</th>
                    <th scope="col">Logic count</th>
                    <th scope="col">Operator</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @foreach($segment->segmentLogic as $segmentLogic)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $segment->name }}</td>
                    <td>{{ $segmentLogic->action_type }}</td>
                    <td>{{ $segmentLogic->action_column }}</td>
                    <td>{{ $segmentLogic->logic_type }}</td>
                    <td>{{ $segmentLogic->logic_value }}</td>
                    <td>{{ $segmentLogic->logic_operator }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <h6 class="pt-4">Subscribers</h6>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Created at</th>
                    <th scope="col">updated at</th>
                </tr>
                </thead>
                <tbody>
                @php($c = 1)
                @foreach( $subscribers_data as $subscriber)
                <tr>
                    <th scope="row">{{ $c++ }}</th>
                    <td>{{ $subscriber->first_name }}</td>
                    <td>{{ $subscriber->last_name }}</td>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->birth_day }}</td>
                    <td>{{ $subscriber->created_at }}</td>
                    <td>{{ $subscriber->updated_at }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('/') }}" class="btn btn-dark btn-sm">Back</a>
    </div>

@endsection
