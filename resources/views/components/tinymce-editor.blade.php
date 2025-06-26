{{-- TinyMCE Rich Text Editor Component --}}
@php
    $editorId = $editorId ?? 'editor_' . uniqid();
    $height = $height ?? 300;
    $placeholder = $placeholder ?? 'Enter text here...';
@endphp

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    tinymce.init({
        selector: '#{{ $editorId }}',
        height: {{ $height }},
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        placeholder: '{{ $placeholder }}',
        branding: false,
        promotion: false,
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
});
</script>
