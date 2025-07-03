@extends('layouts.default')

@section('content')

    <div class="d-flex align-items-center">
    <div class="container card shadow-sm" style="margin-top:100px; max-width: 500px">
        <div class="fs-3 fw-bold text-center">Add new task</div>
        <form class="p-3" method="POST" action="{{route('task.add.post')}}">
            @csrf
            <div class="mb-3 mt-1">
                <input type="text" name="title" class="form-control"  placeholder="Enter task title">
            </div>

            <div class="mb-3">
                <input type="datetime-local" class="form-control" name="deadline">
            </div>

            <div class="mb-3">
                <textarea class="form-control"  name="description" rows="3"
                placeholder="Task description..."></textarea>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

            <button class="btn btn-success rounded-pill" type="submit" >Submit</button>
        </form>
    </div>
    </div>
@endsection
