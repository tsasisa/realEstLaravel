@extends('layouts.admin')


@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Gallery</h5>
                <form method="POST" action="{{route('save.gallery')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Property Images</label>
                        <input name="image[]" class="form-control" type="file" id="formFileMultiple" multiple>
                        @error('image.*')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <select name="prop_id" class="form-control mt-3 mb-4 form-select"
                        aria-label="Default select example">
                        <option selected>Select Property</option>
                        @foreach($showprops as $pr)
                            <option value={{$pr->id}}>{{$pr->title}}</option>
                        @endforeach
                        @error('prop_id')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </select>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection