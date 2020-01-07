<!DOCTYPE html>
<html>
<head>
    <title>Create file</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    <!-- <h1>Laravel 5.8 Ajax CRUD tutorial using Datatable - ItSolutionStuff.com</h1> -->
    <a id="btn-download" href="{{ route('frontend.fms.files.download') }}" class="btn btn-outline-primary"> EXPORT</a>
    <a class="btn btn-success" href="{{ route('frontend.fms.file.create') }}" id="createNewProduct">Add file</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <!-- <th>ID</th> -->
                <th>Subject</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Folder</th> 
                <th>File Index</th>
                <th>Pub Date</th>
                <th>Rec Date</th>
                <!-- <th>Current</th> -->
              
                <!-- <th>Folder Name</th> -->
                <th width="180px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<!-- <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
            {{ html()->form('POST', route('frontend.fms.file.store'))->open() }}
            
                    <div class="form-group ">
                            {{html()->label('file Name')->class('form-control-label')->for('file_name')}}
                            {{html()->text('file_name')->class('form-control')->placeholder('Enter file Name')}}
                    </div>
                    
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">@lang('labels.general.buttons.save')</button>
                    </div>
            
                    {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div> -->
    
</body>
    
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('frontend.fms.file.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'id', name: 'id'},
            {data: 'file_subject_title', name: 'file_subject_title'},
            {data: 'file_author_name', name: 'file_author_name'},
            {data: 'publisher_name', name: 'publisher_name'},
            {data: 'folder_name', name: 'folder_name'},
            {data: 'reference_code', name: 'reference_code'},
            {data: 'file_published_date', name: 'file_published_date'},
            {data: 'file_received_date', name: 'file_received_date'},
            // {data: 'current_movement_id', name: 'current_movement_id'},
             
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#file_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Add file");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editProduct', function () {
      var file_id = $(this).data('id');
      $.get("{{ route('frontend.fms.file.index') }}" +'/' + file_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#file_id').val(data.id);
          $('#name').val(data.name);
       
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('frontend.fms.file.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteProduct', function () {
     
        var file_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('frontend.fms.file.store') }}"+'/'+file_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</html>