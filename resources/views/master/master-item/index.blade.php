@extends('layouts.master')

@section('title', trans('menu.master-item'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <form class="form-horizontal" role="form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('itemCode') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.item-code') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="itemCode" class="form-control" value="{{ !empty($filters['itemCode']) ? $filters['itemCode'] : '' }}">
                                @if($errors->has('itemCode'))
                                    <span class="help-block">{{ $errors->first('itemCode') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('itemName') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.name') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="itemName" class="form-control" value="{{ !empty($filters['itemName']) ? $filters['itemName'] : '' }}">
                                @if($errors->has('itemName'))
                                    <span class="help-block">{{ $errors->first('itemName') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('barcode') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.barcode') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="barcode" class="form-control" value="{{ !empty($filters['barcode']) ? $filters['barcode'] : '' }}">
                                @if($errors->has('barcode'))
                                    <span class="help-block">{{ $errors->first('barcode') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
                            <div class="col-sm-offset-2 col-sm-10">
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
                            <a href="{{ route('master-item-add') }}" class="btn btn-primary waves-effect w-md waves-light"><i class="fa fa-plus"></i> {{ trans('fields.add-new') }}</a>
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
                            <th width="5%" class="text-center">{{ trans('fields.num') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.item-code') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.name') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.barcode') }}</th>
                            <th width="30%" class="text-center">{{ trans('fields.description') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.uom') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.category') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.is-active') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($models->currentPage() - 1) * $models->perPage() + 1; ?>
                        @foreach($models as $model)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $model->item_code }}</td>
                            <td>{{ $model->item_name }}</td>
                            <td>{{ $model->barcode }}</td>
                            <td>{{ $model->description }}</td>
                            <td>{{ $model->uom_code }}</td>
                            <td>{{ $model->category_name }}</td>
                            <td class="text-center">
                                <i class="fa {{ $model->is_active ? 'fa-check' : 'fa-remove' }}"></i>
                            </td>
                            <td class="text-center">
                                @can('access', [$resource, 'update'])
                                <a href="{{ url('master-item/edit/'.$model->item_id) }}" data-toggle="tooltip" class="btn btn-xs btn-warning" data-original-title="Edit">
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