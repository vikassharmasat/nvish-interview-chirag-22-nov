@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('update-avatar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload your pic</label>
                    <input class="form-control" type="file" id="formFile" name="avatar">
                </div>
                <div class="row mb-3">
                    <div class="col-auto">
                        <label for="width" class="visually-hidden">Width</label>
                        <input type="number" class="form-control" name="width" id="width" placeholder="width">
                    </div>
                    <div class="col-auto">
                        <label for="height" class="visually-hidden">Height</label>
                        <input type="number" class="form-control" name="height" id="height" placeholder="height">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
