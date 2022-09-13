@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <label for="exampleDataList" class="form-label">Awesome Todo List
                        <a type="submit" class="btn btn-primary font-weight-bold" href="{{ route('tasks.create')}}">Add</a>
                    </label>
                    <form action="{{ route('tasks.index') }}" method="GET">
                        <div class="d-flex">
                            <input type="text" name="search" class="form-control todo-list-input" placeholder="What do you need to do today?">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>


                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <table class="table">
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <form id="completed-form-{{$task->id}}" action="{{ route('tasks.update', $task) }}" method="POST">
                                        <div class="form-check">
                                            @if($task->completed)
                                            <input class="form-check-input" type="checkbox" checked name="completed" onclick="document.getElementById('completed-form-{{$task->id}}').submit();">
                                            <label class="form-check-label Item-p--complete">
                                                {{ $task->task }}
                                            </label>
                                            @else
                                            <input class="form-check-input" type="checkbox" name="completed" onclick="document.getElementById('completed-form-{{$task->id}}').submit();">
                                            <label class="form-check-label">
                                                {{ $task->task }}
                                            </label>
                                            @endif
                                        </div>
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar..?')">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection