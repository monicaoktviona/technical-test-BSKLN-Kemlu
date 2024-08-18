<!DOCTYPE html>
<html>
<head>
    <title>Datatables Negara</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container mt-5">
    <h2 class="mb-4">List all Data Negara</h2>
    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Negara</th>
                <th>Kawasan</th>
                <th>Direktorat</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function () {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_negara', name: 'nama_negara'},
                {data: 'region.nama_kawasan', name: 'region.nama_kawasan'},
                {data: 'direktorat.nama_direktorat', name: 'direktorat.nama_direktorat'},
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false,
                    render: function(data, type, row) {
                        var date = new Date(data);
                        var formattedDate = date.getFullYear() + '/' +
                            ('0' + (date.getMonth() + 1)).slice(-2) + '/' +
                            ('0' + date.getDate()).slice(-2);
                        return formattedDate;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.delete', function () {
            var id = $(this).data("id");
            if(confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    type: "DELETE",
                    url: "/api/negara/" + id,
                    success: function (data) {
                        table.ajax.reload();
                        alert(data.message);
                    },
                    error: function (data) {
                        alert('Error:', data.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
</html>