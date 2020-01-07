@extends('frontend.layouts.app')

@section('title')
    @lang('labels.general.show') Type
@endsection

@section('content')
  <div class="pull-right"><a class="btn btn-info" role="button" href="{{route('frontend.fms.reference.index')}}">Return</a></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <!-- <h4 class="title">Striped Table</h4>
                    <p class="category">Here is a subtitle for this table</p> -->
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>

                        </thead>
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{$item->id }}</td>
                        </tr>

                        <tr>
                            <th>Publisher Name</th>
                            <td>{{$item->reference_name}}</td>
                        </tr>

                        <tr>
                            <th>Full  Name</th>
                            <td>{{$item->folder_name}}</td>
                        </tr>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
