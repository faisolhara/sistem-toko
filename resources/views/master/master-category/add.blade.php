@extends('layouts.master')

@section('title', trans('menu.master-category'))

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ trans('fields.add-category') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-category-save') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->category_id }}">
                            <div class="form-group {{ $errors->has('categoryName') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.category-name') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="categoryName" class="form-control" value="{{ count($errors) > 0 ? old('categoryName') : $model->category_name }}">
                                    @if($errors->has('categoryName'))
                                        <span class="help-block">{{ $errors->first('categoryName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox checkbox-primary">
                                        <?php $isActive = count($errors) > 0 ? old('isActive') : $model->is_active; ?>
                                        <input id="isActive" name="isActive" value="true" type="checkbox" {{ $isActive == true ? 'checked' : '' }}>
                                        <label for="isActive">
                                            {{ trans('fields.is-active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 data-table-toolbar text-right" style="padding-top: 10px;">
                        <div class="form-group">
                            <a href="{{ url('master-category') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> {{ trans('fields.save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- end row -->
        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>

@endsection
