@extends('layouts.master')

@section('title', trans('menu.master-user'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <form class="form-horizontal" role="form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.name') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" value="{{ !empty($filters['name']) ? $filters['name'] : '' }}">
                                @if($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.username') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="username" class="form-control" value="{{ !empty($filters['username']) ? $filters['username'] : '' }}">
                                @if($errors->has('username'))
                                    <span class="help-block">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.role') }}</label>
                            <div class="col-md-8">
                                <select class="form-control" id="role" name="role">
                                    <option value="">{{ trans('fields.all') }}</option>
                                @foreach($roleOptions as $role)
                                    <option value="{{ $role->role_id }}" {{ !empty($filters['role']) && $filters['role'] == $role->role_id ? 'selected' : ''}} >{{ $role->role_name }}</option>
                                @endforeach
                                </select>
                                @if($errors->has('role'))
                                    <span class="help-block">{{ $errors->first('role') }}</span>
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
                            <a href="{{ route('master-user-add') }}" class="btn btn-primary waves-effect w-md waves-light"><i class="fa fa-plus"></i> {{ trans('fields.add-new') }}</a>
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
                            <th width="30%" class="text-center">{{ trans('fields.name') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.username') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.email') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.role') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($models->currentPage() - 1) * $models->perPage() + 1; ?>
                        @foreach($models as $model)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->username }}</td>
                            <td>{{ $model->email }}</td>
                            <td>{{ $model->role_name }}</td>
                            <td class="text-center">
                                @can('access', [$resource, 'update'])
                                <a href="{{ url('master-user/edit/'.$model->id) }}" data-toggle="tooltip" class="btn btn-xs btn-warning" data-original-title="Edit">
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