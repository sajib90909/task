@extends('master')

@section('title')
    Segments
@endsection

@section('content')
    <div class="content p-4">
        <h4 class="text-center pb-4">Subscribers</h4>
        <div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">updated at</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @foreach($subscribers as $subscriber)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $subscriber->first_name }}</td>
                    <td>{{ $subscriber->last_name }}</td>
                    <td>{{ $subscriber->email }}</td>
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
