@extends('layouts.master')

@section('title', trans('menu.master-uom'))

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ $title.' '.trans('menu.master-uom') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-uom-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->uom_id }}">
                            <div class="form-group {{ $errors->has('uomCode') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.uom-code') }} *</label>
                                <div class="col-md-10">
                                    <input type="text" name="uomCode" class="form-control" value="{{ count($errors) > 0 ? old('uomCode') : $model->uom_code }}">
                                    @if($errors->has('uomCode'))
                                        <span class="help-block">{{ $errors->first('uomCode') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('uomName') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.name') }} *</label>
                                <div class="col-md-10">
                                    <input type="text" name="uomName" class="form-control" value="{{ count($errors) > 0 ? old('uomName') : $model->uom_name }}">
                                    @if($errors->has('uomName'))
                                        <span class="help-block">{{ $errors->first('uomName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('parentBase') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.parent-base') }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="parentBase" name="parentBase">
                                    <?php $parentBaseId = count($errors) > 0 ? old('parentBase') : $model->parent_id; ?>
                                        <option value="">{{ trans('fields.please-select') }}</option>
                                    @foreach($uomOptions as $parentBase)
                                        <option value="{{ $parentBase->uom_id }}" {{ $parentBase->uom_id == $parentBaseId ? 'selected' : '' }}>{{ $parentBase->uom_name }}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('parentBase'))
                                        <span class="help-block">{{ $errors->first('parentBase') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('isBase') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.is-base') }}</label>
                                <div class=" col-sm-10">
                                    <div class="checkbox checkbox-primary">
                                        <?php $isBase = count($errors) > 0 ? old('isBase') : $model->is_base; ?>
                                        <input id="isBase" name="isBase" value="true" type="checkbox" {{ $isBase == true ? 'checked' : '' }}>
                                        <label for="isBase">
                                            {{ trans('fields.yes') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.is-active') }}</label>
                                <div class="col-sm-10">
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
                            <a href="{{ url('master-uom') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
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
$(document).on('ready', function() {
    $('.btn-photo').on('click', function(){
        $(this).parent().find('input[type="file"]').click();
    });

    $("#foto").on('change', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            var $img    = $(this).parent().find('img');
            var $span   = $(this).parent().find('span');
            reader.onload = function (e) {
                $img.attr('src', e.target.result);
                $img.show();
                $span.hide();
            }
            reader.readAsDataURL(this.files[0]);
        }
	});
});
</script>
@endsection