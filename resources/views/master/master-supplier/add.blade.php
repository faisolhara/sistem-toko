@extends('layouts.master')

@section('title', trans('menu.master-supplier'))

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ trans('fields.add') }} {{ trans('menu.master-supplier') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-supplier-save') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->supplier_id }}">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('supplierCode') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.supplier-code') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" name="supplierCode" class="form-control" value="{{ count($errors) > 0 ? old('supplierCode') : $model->supplier_code }}" readonly>
                                        @if($errors->has('supplierCode'))
                                            <span class="help-block">{{ $errors->first('supplierCode') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('supplierName') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.supplier-name') }} *</label>
                                    <div class="col-md-8">
                                        <input type="text" name="supplierName" class="form-control" value="{{ count($errors) > 0 ? old('supplierName') : $model->supplier_name }}">
                                        @if($errors->has('supplierName'))
                                            <span class="help-block">{{ $errors->first('supplierName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('personName') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.person-name') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" name="personName" class="form-control" value="{{ count($errors) > 0 ? old('personName') : $model->person_name }}">
                                        @if($errors->has('personName'))
                                            <span class="help-block">{{ $errors->first('personName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('contactPerson') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.contact-person') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" name="contactPerson" class="form-control" value="{{ count($errors) > 0 ? old('contactPerson') : $model->contact_person }}">
                                        @if($errors->has('contactPerson'))
                                            <span class="help-block">{{ $errors->first('contactPerson') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.telephone') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" name="telephone" class="form-control" value="{{ count($errors) > 0 ? old('telephone') : $model->telephone }}">
                                        @if($errors->has('telephone'))
                                            <span class="help-block">{{ $errors->first('telephone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.address') }}</label>
                                    <div class="col-md-8">
                                        <textarea name="address" id="address" class="form-control" rows="3">{{ count($errors) > 0 ? old('address') : $model->address }}</textarea>
                                        @if($errors->has('address'))
                                            <span class="help-block">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label class="col-md-4 control-label">{{ trans('fields.description') }}</label>
                                    <div class="col-md-8">
                                        <textarea name="description" id="description" class="form-control" rows="3">{{ count($errors) > 0 ? old('description') : $model->description }}</textarea>
                                        @if($errors->has('description'))
                                            <span class="help-block">{{ $errors->first('description') }}</span>
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
                    </div>
                    
                    <div class="col-sm-12 data-table-toolbar text-right" style="padding-top: 10px;">
                        <div class="form-group">
                            <a href="{{ url('master-supplier') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
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
