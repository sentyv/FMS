@extends('frontend.layouts.app')

@section('title')
  @lang('labels.general.show') Type
@endsection

@section('content')

<div class="card">
{{--        <div class="card-header">--}}
<!-- <h4 class="title">Striped Table</h4>
        <p class="category">Here is a subtitle for this table</p> -->
  {{--        </div>--}}
  <div class="card-body">
    <div class="content table-responsive table-full-width">
      <table class="table table-striped">
        <thead></thead>
        <tbody>
        <!-- <tr>
          <th style="text-align:center" rowspan=12 ><img src="{{ URL::to('/') }}/images/fms/{{  $item->file_name }}" width='300'></th>
        </tr> -->
        <tr>
          <th>ID</th>
          <td>{{$item->id }}</td>
        </tr>

        <tr>
          <th>Author</th>
          <td>{{$item->file_author_name}}</td>
        </tr>

        <tr>
          <th>Subject</th>
          <td>{{$item->file_subject_title}}</td>
        </tr>

        <tr>
          <th>Reference Code</th>
          <td>{{ optional($item->reference)->reference_code}}</td>
        </tr>

        <tr>
          <th>Folder Name</th>
          <td>{{ optional($item->reference)->folder_name}}</td>
        </tr>

        <tr>
          <th>File Download</th>
          <td><a href="{{ route('frontend.fms.file.download', $item->id) }}">Download here!!</a></td>
        </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">Movement of Files</div>
  <div class="content table-responsive table-full-width">
    <table class="table table-striped">
      <thead>
      <!-- <th>Officer Notified</th>
      <th>Officer Title</th> -->
      <th>Issued Date</th>
      <th>Return Date</th>
      <!-- <th>Action</th> -->
      </thead>
      <tbody>
        @foreach($item->movements as $movement)
          <tr>
            {{--<td>{{ optional($movement->user)->first_name }}</td>
            <td>{{ optional($movement->user)->name }}</td> --}}
            <td>{{ optional($movement->movement_start_date)->format('d-m-y') }}</td>
            <td>{{ optional($movement->movement_return_date)->format('d-m-y') }}</td>
            <td></td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

            </div>
          </div>
@endsection
