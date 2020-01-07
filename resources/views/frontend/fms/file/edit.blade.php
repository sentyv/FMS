@extends('frontend.layouts.app')

@section('title')
    @lang('buttons.general.crud.edit') FMS Files
@endsection
@section('parentPageTitle')
  <a href='{{ route('frontend.fms.file.index') }}'>Files</a>
@endsection

@push('after-styles')
    {{ style('css/typeaheadjs.css') }}
@endpush

@section('content')
    {{ html()->form('PATCH', route('frontend.fms.file.update', $item->id))->open() }}

    <div class="form-group">
        <label class="" for="referenceName">File Reference Code<i id="loading_reference" class="fas fa-spinner fa-spin"></i></label>
        {{ html()->input('hidden')->id('file_reference_id')->name('file_reference_id')->value(old('file_reference_id', $item->file_reference_id)) }}
        {{ html()->input('search')->class('form-control')->required()
            ->name('file_reference_name')->id('file_reference_name')->attribute('autocomplete','off')
            ->value(old('file_reference_name', optional($item->reference)->getDisplayName()))}}
        <small id="reference-notes" class="form-text text-muted"></small>
    </div>

    <div class="form-group">
        <label for="file_subject_title">File Subject Title</label>
        <input type="text" class="form-control" id="file_subject_title" name="file_subject_title" placeholder ="Enter Subject Title" value="{{ old('file_subject_title', $item->file_subject_title) }}">
    </div>

    <div class="form-group">
        <label for="file_author_name">File Author Name</label>
        <input type="text" class="form-control" id="file_author_name" name="file_author_name" placeholder ="Enter Author Title" value="{{ old('file_author_name', $item->file_author_name) }}">
    </div>

    <div class="form-group">
        <label for="file_published_date">File Published Date</label>
        <input type="date" class="form-control" id="file_published_date" name="file_published_date" value="{{ old('file_published_date', optional($item->file_published_date)->format('Y-m-d')) }}">
    </div>


    <div class="form-group">
        <label for="file_received_date">File Received Date</label>
        <input type="date" class="form-control" id="file_received_date" name="file_received_date" value="{{ old('file_received_date', optional($item->file_received_date)->format('Y-m-d')) }}">
    </div>

    <div class="form-group">
        {{ html()->label('Publisher Name')->class('form-control-label')->for('file_publisher_id') }}
        <select class="form-control" name="file_publisher_id" id="file_publisher_id">
            @foreach($publishers as $key => $name)
                <option value="{{ $key }}" {{ ($key == old('file_publisher_id', $item->file_publisher_id)) ? 'checked' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>


    {{--<div class="form-group">
        <label for="status">Status</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="true" id="status" name="status" {{ (old('status', $item->status ?? false)) ? 'checked' : ''}}>
            <label class="form-check-label" for="defaultCheck1">
                Enabled
            </label>
        </div>
    </div>--}}


    <div class="form-group">
        <button class="btn btn-primary">@lang('labels.general.buttons.update')</button>
    </div>

    {{ html()->form()->close() }}
@endsection

@push('after-scripts')
    {{ script('js/typeahead.bundle.js') }}
    <script>
        var testReferenceName = '';

        function showReferenceSpinner()
        {
            console.log('showReferenceSpinner');
            $('#loading_Reference').show();
        }
        function hideReferenceSpinner()
        {
            console.log('hideReferenceSpinner');
            $('#loading_reference').hide();
        }


        $(document).ready(function() {
            testFileName = $('#file_reference_name').val() ;
            hideReferenceSpinner();

            var references = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    filter: function(parsedResponse){
                        hideReferenceSpinner();
                        return parsedResponse;
                    },
                    wildcard: '%QUERY',
                    url: "{{ route('frontend.fms.reference.typeahead',["%QUERY"]) }}",
                    rateLimitWait: 1000
                }
            });

            $('#file_reference_name').typeahead({
                    hint: false,
                    highlight: true,
                    minLength: 2,
                    limit: 10
                },
                {
                    name: 'References',
                    display: 'name',
                    source: references,
                    templates: {
                        header: '<h4 class="dropdown">References</h4>'
                    }
                })
                .on('typeahead:selected typeahead:autocomplete', function(evt, item) {
                    // do what you want with the item here
                    testReferenceName = item.name;
                    $("#file_reference_id").val(item.id);
                    $("#reference-notes").html('');
                })
                .on('change', function() {
                    var name = $('#file_reference_name').val();
                    if (testReferenceName != name) {
                        $("#reference-notes").html(name + ' is not a known reference.');
                        $("#file_reference_id").val('');
                        $("#file_reference_name").val('');
                        testReferenceName = '' ;
                    }
                });
        });
    </script>
@endpush
