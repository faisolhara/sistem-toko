@extends('layouts.master')

@section('title', trans('menu.item-stock'))

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
                        <div class="form-group {{ $errors->has('stockLessThan') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.stock-less-than') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="stockLessThan" class="form-control" value="{{ !empty($filters['stockLessThan']) ? $filters['stockLessThan'] : '' }}">
                                @if($errors->has('stockLessThan'))
                                    <span class="help-block">{{ $errors->first('stockLessThan') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('stockMoreThan') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.stock-more-than') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="stockMoreThan" class="form-control" value="{{ !empty($filters['stockMoreThan']) ? $filters['stockMoreThan'] : '' }}">
                                @if($errors->has('stockMoreThan'))
                                    <span class="help-block">{{ $errors->first('stockMoreThan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted font-14 m-b-20 pull-right">
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
                            <th width="15%" class="text-center">{{ trans('fields.item-code') }}</th>
                            <th width="35%" class="text-center">{{ trans('fields.name') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.stock') }}</th>
                            <th width="10%" class="text-center">{{ trans('fields.uom') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.last-transaction') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($models->currentPage() - 1) * $models->perPage() + 1; ?>
                        @foreach($models as $model)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $model->item_code }}</td>
                            <td>{{ $model->item_name }}</td>
                            <td class="text-right">{{ number_format($model->stock) }}</td>
                            <td>{{ $model->uom_code }}</td>
                            <td >{{ $model->last_transaction }}</td>
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