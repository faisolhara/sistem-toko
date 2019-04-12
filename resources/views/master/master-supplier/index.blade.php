@extends('layouts.master')

@section('title', trans('menu.master-supplier'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <form class="form-horizontal" role="form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('supplierCode') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.supplier-code') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="supplierCode" class="form-control" value="{{ !empty($filters['supplierCode']) ? $filters['supplierCode'] : '' }}">
                                @if($errors->has('supplierCode'))
                                    <span class="help-block">{{ $errors->first('supplierCode') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('supplierName') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.supplier-name') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="supplierName" class="form-control" value="{{ !empty($filters['supplierName']) ? $filters['supplierName'] : '' }}">
                                @if($errors->has('supplierName'))
                                    <span class="help-block">{{ $errors->first('supplierName') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('personName') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.person-name') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="personName" class="form-control" value="{{ !empty($filters['personName']) ? $filters['personName'] : '' }}">
                                @if($errors->has('personName'))
                                    <span class="help-block">{{ $errors->first('personName') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
                            <div class="col-sm-offset-3 col-sm-9">
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
                            <a href="{{ route('master-supplier-add') }}" class="btn btn-primary waves-effect w-md waves-light"><i class="fa fa-plus"></i> {{ trans('fields.add-new') }}</a>
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
                            <th width="15%" class="text-center">{{ trans('fields.supplier-code') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.supplier-name') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.person-name') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.contact-person') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.telephone') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.description') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.address') }}</th>
                            <th width="10%" class="text-center">{{ trans('fields.is-active') }}</th>
                            <th width="10%" class="text-center">{{ trans('fields.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($models->currentPage() - 1) * $models->perPage() + 1; ?>
                        @foreach($models as $model)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $model->supplier_code }}</td>
                            <td>{{ $model->supplier_name }}</td>
                            <td>{{ $model->person_name }}</td>
                            <td>{{ $model->contact_person }}</td>
                            <td>{{ $model->telephone }}</td>
                            <td>{{ $model->description }}</td>
                            <td>{{ $model->address }}</td>
                            <td class="text-center">
                                <i class="fa {{ $model->is_active ? 'fa-check' : 'fa-remove' }}"></i>
                            </td>                            
                            <td class="text-center">
                            @can('access', [$resource, 'update'])
                                <a href="{{ url($url.'/edit/'.$model->supplier_id) }}" data-toggle="tooltip" class="btn btn-xs btn-warning" data-original-title="Edit">
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