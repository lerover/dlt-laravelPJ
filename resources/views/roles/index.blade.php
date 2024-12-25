@extends('layouts.adminindex')
@section('content')
    <!-- Start Content Area  -->
    <div class="container-fluid">
        <div class="col-md-12">
            <a href="{{route("roles.create")}}" class="btn btn-primary btn-sm rounded-0">Create</a>
        </div>

        <hr/>
        {{--search bar and bulk delete btn--}}
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 mb-2">
                    <a href="javascript:void(0)" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                </div>

                <div class="col-md-10">
                    <form action="">
                        {{--@csrf--}}
                        {{csrf_field()}}
                        <div class="row justify-content-end">
                            <div class="col-md-2 col-sm-6 mb-2 form-group">
                                <div class="input-group">
                                    <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search">
                                    <button type="submit" id="search-btn" class="btn btn-secondary btn-sm" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--table--}}
        <div class="col-md-12">
            <table class="table table-sm table-hover border" id="mytable">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox"  name="selectalls" id="selectalls" class="form-check-input"/>
                    </th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $idx => $role)
                    <tr>
                        <td><input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$role->id}}"></td>
                        <td>{{++$idx}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->status->name}}</td>
                        <td>{{$role->user->name}}</td>
                        <td>{{$role->created_at->format("d M Y")}} {{$role->created_at->diffForHumans()}}</td>
                        <td>{{$role->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="{{route('roles.edit',$role->id)}}" class="text-info"><i class="fas fa-pen"></i></a>
                            <a href="javascript:void(0)" class="text-danger ms-3 delete-btn" data-idx='{{$idx}}' data-name="{{$role->name}}"><i class="fas fa-trash-alt"></i></a>
                            <form action="{{route('roles.destroy',$role->id)}}" method="post" id="formdelete-{{$idx}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script type="text/javascript">
        $('document').ready(function(){
            // single delete
            $('.delete-btn').click(function(){
                const getidx = $(this).data('idx');
                const getname = $(this).data('name');
                if(confirm('Are you sure you want to delete No.'+getidx+'- '+getname)){
                    $('#formdelete-'+getidx).submit();
                    return true;
                }else{
                    return false;
                }
            })

            // bulk delete
            $('#selectalls').click(function(){
                $('.singlechecks').prop('checked',$('#selectalls').prop('checked'));
            })
        })
    </script>
@endsection
