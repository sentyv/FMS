@extends('frontend.layouts.app')

@section('title')
  Issue File {{$file->file_subject_title}}
@endsection
@section('parentPageTitle')
  <a href='{{ route('frontend.fms.file.index') }}'>Files</a>
@endsection


@section('content')
  {{ html()->form('POST', route('frontend.fms.file.movement.store',$file->id))->open() }}
{{$file->id}}

  <div class="form-group ">
    {{ html()->label('Forward Date ')->class('form-control-label')->for('start_date') }}
    {{ html()->date('start_date')->id('start_date')->class('form-control')->required()->data(old('start_date', \Carbon\Carbon::now()->format('Y-m-d'))) }}
  </div>

  <div class="form-group ">
    {{ html()->label('Return Date')->class('form-control-label')->for('movement_start_date')}}
    {{ html()->date('return_date')->class('form-control')->placeholder('Enter Publisher Name')}}
  </div>

  <!-- <div class="form-group ">
    {{ html()->label('User')->class('form-control-label')->for('user')}}
    {{ html()->number('user')->id('user')->class('form-control')->data(old('user',1))->required()->placeholder('Enter user id') }}
  </div> -->

  <div class="form-group">
    <button class="btn btn-primary">@lang('labels.general.buttons.save')</button>
  </div>

  {{ html()->form()->close() }}
@endsection
