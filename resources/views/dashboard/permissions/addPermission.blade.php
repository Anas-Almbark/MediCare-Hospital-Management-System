@extends('dashboard')
@section('content')
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header"> New permission </h5>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="defaultFormControlInput"
                            placeholder="name permission" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success mt-3"> Add </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
