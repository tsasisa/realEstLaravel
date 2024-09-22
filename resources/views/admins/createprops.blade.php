@extends('layouts.admin')

@section('content')

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                    <form method="POST" action="{{route('save.props')}}" enctype="multipart/form-data">
                        <!-- Email input -->
                         @csrf
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
                            @error('title')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>  
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
                            @error('price')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div> 
                        <div class="mb-3">
                          <label for="formFile" class="form-label">Property image</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                            @error('image')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div> 
                     
                        
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="beds" id="form2Example1" class="form-control" placeholder="beds" />
                            @error('beds')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="baths" id="form2Example1" class="form-control" placeholder="baths" />
                            @error('baths')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="sq_ft" id="form2Example1" class="form-control" placeholder="SQ/FT" />
                            @error('sq_ft')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>   
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" id="form2Example1" class="form-control" placeholder="Year Build" />
                            @error('year_built')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" id="form2Example1" class="form-control" placeholder="Price Per SQ FT" />
                            @error('price_sqft')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                          <input type="text" name="location" id="form2Example1" class="form-control" placeholder="location" />
                          @error('location')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div> 
                        
                        <select name="home_type" class="form-control form-select" aria-label="Default select example">
                            <option selected>Select Home Type</option>
                            @foreach($homeTypes as $all)
                            <option value={{$all->hometypes}}>{{$all->hometypes}}</option>
                            @endforeach
                        </select>   
                        <select name="type" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                            <option selected>Select Type</option>
                            <option value="Buy">For Buy</option>
                            <option value="Rent">For Rent</option>
                            <option value="Lease">For Lease</option>
                        </select> 
                        <select name="city" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                          <option selected>Select City</option>
                          <option value="New York">New York</option>
                          <option value="Brooklyn">Brooklyn</option>
                          <option value="London">London</option>
                          <option value="Tokyo">Tokyo</option>
                          <option value="Cairo">Cairo</option>
                      </select>   
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">More Info</label>
                            <textarea placeholder="More Info" name="more_info" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            @error('more_info')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="agent_name" id="form2Example1" class="form-control" placeholder="agent name" />
                            @error('agent_name')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div> 
                        
                        
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
                
                    </form>

            </div>
          </div>
        </div>
      </div>

      @endsection