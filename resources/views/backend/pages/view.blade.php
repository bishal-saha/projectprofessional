@extends('backend.layouts.admin')

@section('page-title', $page->name)
@section('page-heading')
    <i class="icon-magazine text-indigo mr-2"></i>
    <span class="font-weight-semibold">Page</span> - {{ $page->name }} - View
@endsection

@section('breadcrumbs')
    <a href="{{ route('page.index') }}" class="breadcrumb-item">
        <i class="icon-magazine mr-2"></i> Pages
    </a>
    <span class="breadcrumb-item active">{{ $page->name }}</span>
@stop

@section('content')
    @include('backend.partials.alerts')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active"
                               id="details-tab"
                               data-toggle="tab"
                               href="#details"
                               role="tab"
                               aria-controls="home"
                               aria-selected="true">
                                <strong>Content</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               id="authentication-tab"
                               data-toggle="tab"
                               href="#login-details"
                               role="tab"
                               aria-controls="home"
                               aria-selected="true">
                                <strong>SEO</strong>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="nav-tabContent">
                        <div class="tab-pane fade show active px-2" id="details" role="tabpanel" aria-labelledby="nav-home-tab">
                            <dl class="row">
                                <dt class="col-md-4">Name:</dt>
                                <dd class="col-md-8">{{ $page->name }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-4">Slug:</dt>
                                <dd class="col-md-8">{{ $page->slug }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-4">Excerpt:</dt>
                                <dd class="col-md-8">{{ $page->excerpt }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-4">Content:</dt>
                                <dd class="col-md-8">{{ $page->excerpt }}</dd>
                            </dl>
                        </div>
                        <div class="tab-pane fade px-2" id="login-details" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <dl class="row">
                                <dt class="col-md-2">Meta Title:</dt>
                                <dd class="col-md-10">{{ $page->meta_title }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-2">Meta Keywords:</dt>
                                <dd class="col-md-10">{{ $page->meta_keywords }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-2">Meta Description:</dt>
                                <dd class="col-md-10">{{ $page->meta_description }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-img-actions">
                        <img class="img-fluid rounded-circle" src="{{ $page->image }}" alt="" width="150">
                        <a class="btn bg-teal-400 btn-block mb-2 legitRipple mt-3" href="{{ route('page.edit', $page->slug) }}">
                            Edit Details <i class="fa icon-paperplane ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop