@extends('frontend.layouts.app')

@section('title')
    @lang('buttons.general.crud.edit') Publisher Name
@endsection

@section('content')
    {{ html()->form('PATCH', route('frontend.fms.publisher.update', $item->id))->open() }}

    <div class="form-group">
        <label for="island_name">Publisher Name</label>
        <input type="text" class="form-control" id="publisher_name" name="publisher_name" placeholder="Publisher Name" required maxlength="50"
               value="{{old('publisher_name', $item->publisher_name)}}" />
    </div>

    <div class="form-group">
        <label for="island_name">Publisher Full Name</label>
        <input type="text" class="form-control" id="publisher_full_name" name="publisher_full_name" placeholder="Publisher Full Name" required maxlength="50"
               value="{{old('publisher_full_name', $item->publisher_full_name)}}" />
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">@lang('labels.general.buttons.update')</button>
    </div>

    {{ html()->form()->close() }}
@endsection
