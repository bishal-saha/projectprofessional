@extends('backend.layouts.admin')

@section('page-title', 'Pages')

@section('page-heading')
    <i class="icon-magazine text-indigo mr-2"></i>
    <span class="font-weight-semibold">Page</span> -
    {{ $edit ? $page->name : 'Add New' }}
@endsection

@section('breadcrumbs')
    <a href="{{ route('page.index') }}" class="breadcrumb-item"><i class="icon-magazine mr-2"></i> Pages</a>
    <span class="breadcrumb-item active">{{ $edit ? 'Edit' : 'Add' }}</span>
@stop

@section('content')

    @include('backend.partials.alerts')

    <div id="myApp">
        @if ($edit)
            <form action="{{ route('page.update', $page->slug) }}" method="POST" id="update-form">
                <input type="hidden" name="_method" value="PUT">
        @else
            <form action="{{ route('page.store') }}" method="POST" id="create-form">
        @endif
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active"
                                       id="tab-heading-1"
                                       data-toggle="tab"
                                       href="#tab-content-1"
                                       role="tab"
                                       aria-controls="home"
                                       aria-selected="true">
                                        <strong>Page Details</strong>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       id="tab-heading-2"
                                       data-toggle="tab"
                                       href="#tab-content-2"
                                       role="tab"
                                       aria-controls="home"
                                       aria-selected="true">
                                        <strong>Meta Tag Details</strong>
                                    </a>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="tab-content-1" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input v-model="name" type="text" class="form-control" id="name" name="name" placeholder="Page Name" value="{{ $edit ? $page->name : old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="display_name">Slug</label>
                                            <input v-model="slug" type="text" class="form-control" id="slug" name="slug" placeholder="Slug" >
                                        </div>
                                        <div class="form-group">
                                            <label for="excerpt">Excerpt</label>
                                            <textarea name="excerpt" id="excerpt" class="form-control" rows="5">{{ $edit ? $page->excerpt : old('excerpt') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-content-2" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="form-group">
                                            <label for="name">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" value="{{ $edit ? $page->meta_title : old('meta_title') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="display_name">Meta Keywords</label>
                                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" value="{{ $edit ? $page->meta_keywords : old('meta_keywords') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ $edit ? $page->meta_description : old('meta_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn bg-indigo btn-block mb-3 legitRipple">
                                    {{ $edit ? 'Update' : 'Add' }} <i class="fa icon-paperplane ml-2"></i>
                                </button>
                                @if ($edit)
                                <button type="button" @click="deleteRecords('{{ $page->slug }}')" class="btn bg-pink btn-block mb-3 legitRipple">
                                    Delete This Page <i class="fa icon-trash ml-2"></i>
                                </button>
                                @endif
                                <a class="btn bg-green btn-block legitRipple" href="{{ route('page.index') }}">
                                    Return to Pages <i class="fa icon-arrow-left52 ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"><label for="content">Content</label></div>
                            </div>

                            <textarea name="content" id="content" rows="4" cols="4">
                                {{ $edit ? $page->content : '' }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </form>
            <form :action="actionUrl" id="form_delete" name="form_delete" method="POST">
                @csrf
                <input type="hidden" name="slugs" :value="selectedIds">
                <input type="hidden" name="_method" value="DELETE">
            </form>
    </div>
@endsection

@push('footer')
    @if ($edit)
        {!! JsValidator::formRequest('App\Http\Requests\Page\UpdatePageRequest', '#update-form') !!}
    @else
        {!! JsValidator::formRequest('App\Http\Requests\Page\CreatePageRequest', '#create-form') !!}
    @endif
    <script src="{{ asset('backend/global_assets/js/plugins/editors/ckeditor/ckeditor.js') }}"></script>
    <script>

        const myApp = new Vue({
            el: '#myApp',
            data: {
                actionUrl: '',
                selectedIds: [],
                originalName: '{{ $edit ? $page->name : ''}}',
                name: '{{ $edit ? $page->name : ''}}',
            },
            computed: {
                slug: function( ){
                    if (this.name !== this.originalName) {
                        axios.post("{{ route('page.slug.suggestion') }}", {
                            name: this.name
                        }).then(function (response) {
                                $('#slug').val(response.data);
                                return response.data;
                        }).catch(function (error) {
                                console.log(error);
                        });
                    } else {
                        $('#slug').val('{{ $edit ? $page->slug : ''}}');
                        return '{{ $edit ? $page->slug : ''}}';
                    }
                }
            },
            methods: {
                getSlugSuggestion: function(slug) {
                    axios.post("{{ route('page.slug.suggestion') }}", {
                        name: this.name
                    })
                        .then(function (response) {
                            console.log(response);
                            return response;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                deleteRecords: function (slug) {
                    this.actionUrl = '{{ route('page.delete') }}';

                    // if single delete
                    if (slug) {
                        this.selectedIds = slug;
                    }

                    swal({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this record!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function (result) {
                        if (result.value) {
                            $('#form_delete').submit();
                        }
                    });
                }
            }
        });

        var CKEditor = function() {
            // CKEditor
            var _componentCKEditor = function() {
                if (typeof CKEDITOR == 'undefined') {
                    console.warn('Warning - ckeditor.js is not loaded.');
                    return;
                }

                var editor = CKEDITOR.replace('content', {
                    height: 400,
                    extraPlugins: 'forms',
                    // Configure your file manager integration.
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

                });
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
    </script>
@endpush