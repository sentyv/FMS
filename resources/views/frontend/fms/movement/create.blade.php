@extends('frontend.layouts.app')

@section('content')
{{ html()->form('POST', route('frontend.fms.movement.store'))->open() }}

<input type="hidden" name="files_id" id="files_id" value="{{ old('files_id',1) }}">
<div class="form-group ">
{{html()->label('Forward Date ')->class('form-control-label')->for('movement_start_date')}}
{{html()->date('movement_start_name')->class('form-control')->placeholder('Enter Publisher Name')}}
</div>

<div class="form-group ">
{{html()->label('Return Date')->class('form-control-label')->for('movement_start_date')}}
{{html()->date('movement_start_name')->class('form-control')->placeholder('Enter Publisher Name')}}
</div>
{{--<div class="form-group">
        {{ html()->label('File Name')->class('form-control-label')->for('file_id') }}
        <select class="form-control" name="file_id" id="file_id">
            @foreach($files as $key => $name)
                <option value="{{ $key }}" {{ ($key == old('file_id')) ? 'checked' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
--}}

  
    <div class="form-group">

        <button class="btn btn-primary">@lang('labels.general.buttons.save')</button>
    </div>

    {{ html()->form()->close() }}
@endsection
