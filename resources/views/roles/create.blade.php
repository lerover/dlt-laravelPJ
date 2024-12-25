@extends('layouts.adminindex')
@section('content')
    <!-- Start Content Area  -->
    <div class="container-fluid">
        {{--input for Payment Types--}}
        <div class="col-md-12">
            <form action="{{url('/roles')}}" method="POST" enctype="multipart/form-data">
                {{--@csrf--}}
                {{csrf_field()}}
                <div class="row align-items-end">
{{--                    images--}}
                    <div class="col-md-3 form-group">
                        <label for="image">
                            Image
                        </label>
                        <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" placeholder="Enter Role Type">
                    </div>

                    {{--                    roles --}}
                    <div class="col-md-3 form-group">
                        <label for="name">
                            Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Role Type">
                    </div>

                    {{--                    status--}}
                    <div class="col-md-3 form-group">
                        <label for="status_id">
                            Status <span class="text-danger">*</span>
                        </label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            <option value="" selected disabled>Select Status</option>
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <a href="{{route('roles.index')}}" type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>
                </div>
            </form>

        </div>

        <hr/>


    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script type="text/javascript">
        $('document').ready(function(){

        })
    </script>
@endsection
