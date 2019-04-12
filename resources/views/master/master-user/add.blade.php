@extends('layouts.master')

@section('title', trans('menu.master-user'))

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ trans('fields.add-user') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-user-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->id }}">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.name') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="name" class="form-control" value="{{ count($errors) > 0 ? old('name') : $model->name }}">
                                    @if($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.username') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="username" class="form-control" value="{{ count($errors) > 0 ? old('username') : $model->username }}">
                                    @if($errors->has('username'))
                                        <span class="help-block">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.email') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="email" class="form-control" value="{{ count($errors) > 0 ? old('email') : $model->email }}">
                                    @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.password') }}</label>
                                <div class="col-md-10">
                                    <input type="password" name="password" class="form-control" value="{{ count($errors) > 0 ? old('password') : '' }}">
                                    @if($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.foto') }}</label>
                                <div class="col-md-10">
                                    <input type="file" id="foto" name="foto" style="display:none">
                                    <div class="btn btn-photo well text-center" style="padding: 5px; margin: 0px;">
                                        @if(!empty($model->foto))
                                        <img height="150" src="{{ asset(Config::get('app.paths.foto-user').'/'.$model->foto) }}"/><span></span>
                                        @else
                                        <img height="150" hidden/><span>{{ trans('fields.choose-file') }}</span>
                                        @endif
                                    </div>
                                    @if($errors->has('foto'))
                                        <span class="help-block">{{ $errors->first('foto') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.role') }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="role" name="role">
                                    <?php $roleId = count($errors) > 0 ? old('role') : $model->role_id; ?>
                                        <option value="">{{ trans('fields.please-select') }}</option>
                                    @foreach($roleOptions as $role)
                                        <option value="{{ $role->role_id }}" {{ $role->role_id == $roleId ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('role'))
                                        <span class="help-block">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('isSuperAdmin') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.is-super-admin') }}</label>
                                <div class=" col-sm-10">
                                    <div class="checkbox checkbox-primary">
                                        <?php $isSuperAdmin = count($errors) > 0 ? old('isSuperAdmin') : $model->is_super_admin; ?>
                                        <input id="isSuperAdmin" name="isSuperAdmin" value="true" type="checkbox" {{ $isSuperAdmin == true ? 'checked' : '' }}>
                                        <label for="isSuperAdmin">
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
                            <a href="{{ url('master-user') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
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