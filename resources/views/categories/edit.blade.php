@extends('layouts.app', ['title' => __('Edit Category')])

@section('content')
    @include('categories.partials.header', ['title' => __('Edit Category')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit Category') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('categories.update', ['category' => $category]) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Category information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $category->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('parent_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="select-parent-category">{{ __('Parent Category') }}</label>
                                    <select type="select" name="parent_id" id="select-parent-category" class="form-control form-control-alternative{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Parent Category') }}" value="{{ old('parent_id') }}"  autofocus>
                                        @if(!empty($categories))
                                            <option value="">Parent Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('parent_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="card border-0" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ $category->categoryImages->count() > 0 ? $category->image_folder . '/' . $category->categoryImages->first()->image : '' }}" alt="{{ !empty($image = $category->categoryImages->first()) ? $image->alt : '' }}">
                                    <div class="card-body bg-secondary">
                                        <div class="form-group">
                                            <div>
                                                @if($category->categoryImages->first()->image)
                                                    <label for="image" size="sm" class="btn btn-warning mt-4 btn-sm btn-file">Remove Image
                                                        <input type="file" class="d-none" id="image" name="image">
                                                    </label>
                                                @endif
                                                <label for="image" size="sm" class="btn btn-primary mt-4 btn-sm btn-file">@if($category->categoryImages->first()->image) Change @else Upload @endif Image
                                                    <input type="file" class="d-none" id="image" name="image">
                                                </label>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('alt') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="alt">{{ __('Image alt') }}</label>
                                    <input type="text" name="alt" id="alt" class="form-control form-control-alternative{{ $errors->has('alt') ? ' is-invalid' : '' }}" placeholder="{{ __('Image alt') }}" value="{{ old('alt') ?? $category->categoryImages->first()->alt ?? ''}}" autofocus>
                                    @if ($errors->has('alt'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alt') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
