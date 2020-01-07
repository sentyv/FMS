@extends('frontend.layouts.app')

@section('title')
        @lang('buttons.general.crud.create') References
@endsection

@section('content')
        {{ html()->form('POST', route('frontend.fms.reference.store'))->open() }}

        <div class="form-group ">
                {{html()->label('Reference Name')->class('form-control-label')->for('reference_code')}}
                {{html()->text('reference_code')->class('form-control')->placeholder('Enter Reference Name')}}
        </div>
        <div class="form-group ">
                {{html()->label('Folder Name')->class('form-control-label')->for('folder_name')}}
                {{html()->text('folder_name')->class('form-control')->placeholder('Enter Folder Name')}}
        </div>


        <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">@lang('labels.general.buttons.save')</button>
        </div>

        {{ html()->form()->close() }}
@endsection
