@extends('layouts.master')

@section('title', trans('menu.master-category'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <form class="form-horizontal" role="form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('categoryName') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.category-name') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="categoryName" class="form-control" value="{{ !empty($filters['categoryName']) ? $filters['categoryName'] : '' }}">
                                @if($errors->has('categoryName'))
                                    <span class="help-block">{{ $errors->first('categoryName') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
                            <div class="col-sm-offset-4 col-sm-8">
                                <div class="checkbox checkbox-primary">
                                    <?php $isActive = !empty($filters['isActive']) || !Session::has('filters') ?>
                                    <input id="isActive" name="isActive" value="true" type="checkbox" {{ $isActive == true ? 'checked' : '' }}>
                                    <label for="isActive">
                                        {{ trans('fields.is-active') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted font-14 m-b-20 pull-right">
                            @can('access', [$resource, 'add'])
                            <a href="{{ route('master-category-add') }}" class="btn btn-primary waves-effect w-md waves-light"><i class="fa fa-plus"></i> {{ trans('fields.add-new') }}</a>
                            @endcan
                            <button type="submit" class="btn btn-info waves-effect w-md waves-light"><i class="fa fa-search"></i> {{ trans('fields.search') }}</button>
                        </p>
                    </div>
                </form>
            </div>
            <div class="row">
                <table class="table table-bordered table-hover table-striped m-0">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">{{ trans('fields.num') }}</th>
                            <th width="45%" class="text-center">{{ trans('fields.category-name') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.is-active') }}</th>
                            <th width="30%" class="text-center">{{ trans('fields.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($models->currentPage() - 1) * $models->perPage() + 1; ?>
                        @foreach($models as $model)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $model->category_name }}</td>
                            <td class="text-center">
                                <i class="fa {{ $model->is_active ? 'fa-check' : 'fa-remove' }}"></i>
                            </td>                            
                            <td class="text-center">
                            @can('access', [$resource, 'update'])
                                <a href="{{ url($url.'/edit/'.$model->category_id) }}" data-toggle="tooltip" class="btn btn-xs btn-warning" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="data-table-toolbar">
                    {!! $models->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection