@extends('frontend.layouts.app')

@section('title')
    @lang('buttons.general.crud.edit') References
@endsection

@section('content')
    {{ html()->form('PATCH', route('frontend.fms.reference.update', $item->id))->open() }}

    <div class="form-group">
        <label for="island_name">Reference Name</label>
        <input type="text" class="form-control" id="reference_code" name="reference_code" placeholder="Reference Code" required maxlength="50"
               value="{{old('reference_code', $item->reference_code)}}" />
    </div>

    <div class="form-group">
        <label for="island_name">Folder Name</label>
        <input type="text" class="form-control" id="folder_name" name="folder_name" placeholder="Folder Name" required maxlength="50"
               value="{{old('folder_name', $item->folder_name)}}" />
    </div>



    <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">@lang('labels.general.buttons.update')</button>
    </div>

    {{ html()->form()->close() }}
@endsection
