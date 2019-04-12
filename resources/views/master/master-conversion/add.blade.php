@extends('layouts.master')

@section('title', trans('menu.master-conversion'))

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ $title.' '.trans('menu.master-conversion') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-conversion-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-20">
                            <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->conversion_id }}">
                            <div class="form-group {{ $errors->has('uomFrom') ? 'has-error' : '' }}">
                                <label class="col-md-4 control-label">{{ trans('fields.uom-name') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="uomFrom" name="uomFrom">
                                    <?php $uomFromId = count($errors) > 0 ? old('uomFrom') : $model->uom_id_from; ?>
                                        <option value="">{{ trans('fields.please-select') }}</option>
                                    @foreach($uomOptionFrom as $uomFrom)
                                        <option value="{{ $uomFrom->uom_id }}" {{ $uomFrom->uom_id == $uomFromId ? 'selected' : '' }}>{{ $uomFrom->uom_name }}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('uomFrom'))
                                        <span class="help-block">{{ $errors->first('uomFrom') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('uomTo') ? 'has-error' : '' }}">
                                <label class="col-md-4 control-label">{{ trans('fields.parent-base') }}</label>
                                <div class="col-md-8">
                                    <?php 
                                        $uomToId = !empty($model->conversion_id) ? $model->uomTo->uom_id : '';
                                        $uomTo = !empty($model->conversion_id) ? $model->uomTo->uom_name : '';
                                     ?>
                                    <input type="hidden" id="uomToId" name="uomToId" class="form-control" readonly value="{{ count($errors) > 0 ? old('uomToId') : $uomToId }}">
                                    <input type="text" id="uomTo" name="uomTo" class="form-control" readonly value="{{ count($errors) > 0 ? old('uomTo') : $uomTo }}">
                                    @if($errors->has('uomTo'))
                                        <span class="help-block">{{ $errors->first('uomTo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('conversion') ? 'has-error' : '' }}">
                                <label class="col-md-4 control-label">{{ trans('fields.conversion') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="conversion" class="form-control currency" value="{{ count($errors) > 0 ? old('conversion') : $model->conversion }}">
                                    @if($errors->has('conversion'))
                                        <span class="help-block">{{ $errors->first('conversion') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
                                <label class="col-md-4 control-label">{{ trans('fields.is-active') }}</label>
                                <div class="col-sm-8">
                                    <div class="checkbox checkbox-primary">
                                        <?php $isActive = count($errors) > 0 ? old('isActive') : $model->is_active; ?>
                                        <input id="isActive" name="isActive" value="true" type="checkbox" {{ $isActive == true ? 'checked' : '' }}>
                                        <label for="isActive">
                                            {{ trans('fields.yes') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 data-table-toolbar text-right">
                        <div class="form-group">
                            <a href="{{ url('master-conversion') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
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

@section('script')
@parent
<script type="text/javascript">
$(document).ready(function() {
    $('#uomFrom').on('change', function (e) {
        var uomFrom = $('#uomFrom').val();
        $.ajax({
            url: '{{URL("/master-conversion/get-uom")}}',
            data: {uomFrom: uomFrom},
            success: function( data ) {
                $("#uomToId").val(data.uom_id);        
                $("#uomTo").val(data.uom_name);        
            }
        });
    });
});
</script>
@endsection