var CKEditor = function() {
    // CKEditor
    var _componentCKEditor = function() {
        if (typeof CKEDITOR == 'undefined') {
            console.warn('Warning - ckeditor.js is not loaded.');
            return;
        }

        var editor = CKEDITOR.replace('editor-full', {
            height: 400,
            extraPlugins: 'forms',
            // Configure your file manager integration.
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });

        CKFinder.setupCKEditor( editor );
    };
    return {
        init: function() {
            _componentCKEditor();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    CKEditor.init();
});