@extends('frontend.layouts.app')

@section('title')
        @lang('buttons.general.crud.create') Publisher Name
@endsection

@section('content')
        {{ html()->form('POST', route('frontend.fms.publisher.store'))->open() }}

        <div class="form-group ">
                {{html()->label('Publisher Name')->class('form-control-label')->for('publisher_name')}}
                {{html()->text('publisher_name')->class('form-control')->placeholder('Enter Publisher Name')}}
        </div>
        <div class="form-group ">
                {{html()->label('Publisher Full Name')->class('form-control-label')->for('publisher_full_name')}}
                {{html()->text('publisher_full_name')->class('form-control')->placeholder('Enter Publisher Full Name')}}
        </div>


        <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">@lang('labels.general.buttons.save')</button>
        </div>

        {{ html()->form()->close() }}
@endsection
