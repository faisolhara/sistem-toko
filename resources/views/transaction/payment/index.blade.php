@extends('layouts.master')

@section('title', trans('menu.payment'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <form class="form-horizontal" role="form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('paymentNumber') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.item-code') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="paymentNumber" class="form-control" value="{{ !empty($filters['paymentNumber']) ? $filters['paymentNumber'] : '' }}">
                                @if($errors->has('paymentNumber'))
                                    <span class="help-block">{{ $errors->first('paymentNumber') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('dateFrom') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.date-from') }}</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" style="position: relative; z-index: 100000;" value="{{ !empty($filters['dateFrom']) ? $filters['dateFrom'] : '' }}">
                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                </div>
                                @if($errors->has('dateFrom'))
                                    <span class="help-block">{{ $errors->first('dateFrom') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('dateTo') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('fields.date-to') }}</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" style="position: relative; z-index: 100000;" value="{{ !empty($filters['dateTo']) ? $filters['dateTo'] : '' }}">
                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                </div>
                                @if($errors->has('dateTo'))
                                    <span class="help-block">{{ $errors->first('dateTo') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted font-14 m-b-20 pull-right">
                            @can('access', [$resource, 'add'])
                            <a href="{{ route('payment-add') }}" class="btn btn-primary waves-effect w-md waves-light"><i class="fa fa-plus"></i> {{ trans('fields.add-new') }}</a>
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
                            <th width="20%" class="text-center">{{ trans('fields.payment-number') }}</th>
                            <th width="20%" class="text-center">{{ trans('fields.payment-date') }}</th>
                            <th width="30%" class="text-center">{{ trans('fields.description') }}</th>
                            <th width="15%" class="text-center">{{ trans('fields.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($models->currentPage() - 1) * $models->perPage() + 1; ?>
                        @foreach($models as $model)
                        <?php 
                        $paymentDate = !empty($model->created_date) ? new \DateTime($model->created_date) : null;
                        ?>
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $model->payment_number }}</td>
                            <td>{{ !empty($paymentDate) ? $paymentDate->format('d M Y') : '' }}</td>
                            <td>{{ $model->supplier_name }}</td>
                            <td>{{ $model->description }}</td>
                            <td class="text-center">
                                @can('access', [$resource, 'update'])
                                <a href="{{ url('payment/edit/'.$model->payment_header_id) }}" data-toggle="tooltip" class="btn btn-xs btn-warning" data-original-title="Edit">
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
