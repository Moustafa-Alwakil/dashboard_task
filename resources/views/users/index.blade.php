@extends('layouts.layout')

@section('title', 'Users')

@section('content')
    <div class="text-end mb-3">
        <a href="{{route('users.create')}}" class="btn btn-success btn-lg">Add User</a>
    </div>
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Title</th>
            <th scope="col">specialty</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th>{{$user->id}}</th>
                <td id="">{{$user->name}}</td>
                <td id="">{{$user->email}}</td>
                <td>{{$user->title}}</td>
                <td>{{$user->specialty}}</td>
                <td>{{$user->phone}}</td>

                <td>
                    <img src="{{$user->imgSrc()}}" class="img-fluid rounded-circle" width="90" height="90">
                </td>
                <td>
                    <a href="{{route('users.edit',$user)}}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{route('users.destroy',$user)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i
                                class="bi bi-trash"></i></button>
                    </form>
                    <button class="btn btn-primary"
                            onclick="printId('{{ucwords($user->name)}}','{{ucwords($user->title)}}')"><i
                            class="bi bi-printer"></i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $users->links() !!}
    </div>
@endsection
@push('scripts')
    <script>
        function printId(name, title) {
            var mywindow = window.open('', 'PRINT');

            mywindow.document.write('<html><head><title>ID</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1 style="text-align: center">Name: ' + name + '</h1>');
            mywindow.document.write('<h1 style="text-align: center">Title: ' + title + '</h1>');
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.focus();

            mywindow.print();
            mywindow.close();

            return true;
        }
    </script>
@endpush
