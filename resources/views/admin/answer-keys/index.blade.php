@extends('adminlte::page')

@section('title', 'Answer Keys - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Answer Keys</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.answer-keys.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Answer Key
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
            <h3 class="card-title">All Answer Keys</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <select class="form-control" id="jobPostFilter">
                        <option value="">All Job Posts</option>
                        @foreach($jobPosts as $jobPost)
                            <option value="{{ $jobPost->id }}">{{ Str::limit($jobPost->title, 30) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="answerKeysTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Job Post</th>
                        <th>Organization</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Downloads</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($answerKeys as $answerKey)
                    <tr>
                        <td>{{ $answerKey->id }}</td>
                        <td>
                            <strong>{{ Str::limit($answerKey->title, 40) }}</strong>
                            <br><small class="text-muted">{{ $answerKey->slug }}</small>
                        </td>
                        <td>{{ Str::limit($answerKey->jobPost->title, 30) }}</td>
                        <td>{{ $answerKey->organization }}</td>
                        <td>
                            @if($answerKey->exam_date)
                                {{ $answerKey->exam_date->format('M d, Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $answerKey->status === 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($answerKey->status) }}
                            </span>
                        </td>
                        <td>{{ number_format($answerKey->downloads) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.answer-keys.show', $answerKey) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.answer-keys.edit', $answerKey) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm delete-answer-key" 
                                        data-id="{{ $answerKey->id }}" data-title="{{ $answerKey->title }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="{{ $answerKey->download_link }}" target="_blank" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
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
                    <p>Are you sure you want to delete the answer key "<span id="answerKeyTitle"></span>"?</p>
                    <p><strong>Note:</strong> This action cannot be undone.</p>
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
            let table = $('#answerKeysTable').DataTable({
                responsive: true,
                order: [[ 0, "desc" ]], // Sort by ID descending
                columnDefs: [
                    { orderable: false, targets: [7] } // Disable sorting on Actions column
                ]
            });

            // Job post filter
            $('#jobPostFilter').on('change', function() {
                let jobPostId = $(this).val();
                if (jobPostId) {
                    table.column(2).search('^' + $('#jobPostFilter option:selected').text() + '$', true, false).draw();
                } else {
                    table.column(2).search('').draw();
                }
            });

            let currentAnswerKeyId = null;

            // Delete answer key
            $('.delete-answer-key').on('click', function() {
                currentAnswerKeyId = $(this).data('id');
                let answerKeyTitle = $(this).data('title');
                $('#answerKeyTitle').text(answerKeyTitle);
                $('#deleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (!currentAnswerKeyId) return;
                
                let btn = $(this);
                let originalText = btn.html();
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
                
                $.ajax({
                    url: '{{ route("admin.answer-keys.index") }}/' + currentAnswerKeyId,
                    method: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        toastr.success('Answer key deleted successfully!');
                        
                        // Remove the row from DataTable
                        let row = $('[data-id="' + currentAnswerKeyId + '"]').closest('tr');
                        table.row(row).remove().draw();
                        
                        currentAnswerKeyId = null;
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        toastr.error('An error occurred while deleting the answer key.');
                        currentAnswerKeyId = null;
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
