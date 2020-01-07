@extends('frontend.layouts.app')

<!-- @section('title')
  References Index
@endsection

@push('after-styles')
    {{ style('css/dataTables.bootstrap4.css') }}
@endpush -->

@push('after-scripts')
{{--    {{ script('js/jquery.dataTables.js') }}--}}

    <script>
        var datatable = (function () {
            var permissionEdit = true;
            var permissionEditAll = true;
            var permissionVms = false;
            var ownerOrganisation = 1;

            var table ;

            var init = function (item) {
                var htmlTable = $(item);
                table = htmlTable.DataTable({
                    searching: false,
                    bLengthChange: false,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: htmlTable.data('href'),
                        type: 'post',
                        data: function (d) {
                            d._token = '{!! csrf_token() !!}';
                            //d.search = $('input[name=search]').val();

                        }
                    },
                    columns: [
                        {data: 'reference_code', name: 'reference_code'},
                        {data: 'folder_name', name: 'folder_name'},
                        {data: 'id', name: 'id', searchable: false, sortable: false},

                    ],
                    columnDefs: [
                        {
                            // The `data` parameter refers to the data for the cell (defined by the
                            // `data` option, which defaults to the column being worked with, in
                            // this case `data: 0`.
                            "render": function ( data, type, row ) {
                                if (permissionEditAll || permissionEdit ) {
                                    return "<!-- Split button -->" +
                                        '<div class="btn-group pull-right">' +
                                        '<a href="{{ route('frontend.fms.reference.show',0) }}' + data + '" class="btn btn-outline-info"> @lang('buttons.general.crud.view')</a>' +
                                        '<button class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                        '<span class="caret"></span>' +
                                        '<span class="sr-only">Toggle Dropdown</span>' +
                                        '</button>' +
                                        '<ul class="dropdown-menu">' +
                                        '<li><a href="{{ route('frontend.fms.reference.show',0) }}' + data + '/edit"><i class="fas fa-edit" aria-hidden="true"></i> @lang('buttons.general.crud.edit')</a></li>' +
                                        '<li data-item-id="' + data + '" data-title="Delete License" data-message="Are you sure you want to delete this leave type record ?" >' +
                                        '<a class="formConfirm" href="" onClick="deleteConfirm(event, this)"><i class="fas fa-trash" aria-hidden="true"></i> @lang('buttons.general.crud.delete')</a>' +
                                        '</li></ul></div>';
                                } else {
                                    return '<a href="{{ route('frontend.fms.reference.show', 0) }}' + data + '" class="btn btn-outline-info pull-right">@lang('buttons.general.crud.view')</a>';
                                }
                            },
                            "targets": 2
                        },
                    ]
                });
            };

            var isColumnVisible = function(columnname) {
                var column = table.column( columnname );
                return (column) ? column.visible() : false ;
            }

            var toggleColumn  = function(columnname) {
                var column = table.column( columnname );
                var visible = (! column.visible()) ;
                column.visible( visible );
            }

            var draw = function() { table.draw() ;}
            var row = function(rowSelector) { return table.row(rowSelector) ;}

            // return public methods
            return {
                init: init,
                draw: draw,
                row: row,
                isColumnVisible: isColumnVisible,
                toggleColumn: toggleColumn
            };

        })();

        $(function() {
            datatable.init('#data-table');
        });

    </script>
@endpush

@section('content')
    <table class="table table-hover" id="data-table" width="100%" data-page-length="100"
           data-href="{{ route("frontend.fms.reference.datatables") }}" data-order='[[ 0, "desc" ]]'>
        <thead>
        <tr>
            <!-- <th>ID</th>         -->
            <th>Reference Name</th>
            <th>Folder Name</th>
            <th><a href="{{ route('frontend.fms.reference.create') }}" class="btn btn-outline-info">Create</a></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
