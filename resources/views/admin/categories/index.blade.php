@extends('adminlte::page')

@section('title', 'Categories - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Categories</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Category
            </a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Categories</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="categoriesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Job Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if($category->icon)
                                <i class="{{ $category->icon }}"></i>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $category->sort_order }}</td>
                        <td>{{ $category->jobPosts->count() }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the category "<span id="categoryName"></span>"?</p>
                    <p><strong>Note:</strong> This will also delete all associated job posts.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Configure toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };

            // Initialize DataTable
            $('#categoriesTable').DataTable({
                responsive: true,
                order: [[ 5, "asc" ]], // Sort by sort_order by default
                columnDefs: [
                    { orderable: false, targets: [7] } // Disable sorting on Actions column
                ]
            });

            let currentCategoryId = null;

            // Delete category
            $('.delete-category').on('click', function() {
                currentCategoryId = $(this).data('id');
                let categoryName = $(this).data('name');
                $('#categoryName').text(categoryName);
                $('#deleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (!currentCategoryId) return;
                
                let btn = $(this);
                let originalText = btn.html();
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
                
                $.ajax({
                    url: '{{ route("admin.categories.index") }}/' + currentCategoryId,
                    method: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        toastr.success('Category deleted successfully!');
                        
                        // Remove the row from DataTable
                        let table = $('#categoriesTable').DataTable();
                        let row = $('[data-id="' + currentCategoryId + '"]').closest('tr');
                        table.row(row).remove().draw();
                        
                        currentCategoryId = null;
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        if (xhr.status === 409) {
                            toastr.error('Cannot delete category: It has associated job posts.');
                        } else {
                            toastr.error('An error occurred while deleting the category.');
                        }
                        currentCategoryId = null;
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Show success message if redirected from create/edit
            @if(session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@stop
