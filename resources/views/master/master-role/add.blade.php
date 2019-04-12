@extends('layouts.master')

@section('title', trans('menu.master-role'))

@section('header')
    @parent
    <style> 
        .accordion-header {
            padding : 3px;
            background-color: rgb(224, 224, 224);
            border-style: solid;
            border-width: 1px;
        }
        .accordion-child {
            padding: 1px;
            background-color: rgb(242, 242, 241);
        }
        </style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ trans('fields.add-role') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-role-save') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->role_id }}">
                            <div class="form-group {{ $errors->has('roleName') ? 'has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('fields.role-name') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="roleName" class="form-control" value="{{ count($errors) > 0 ? old('roleName') : $model->role_name }}">
                                    @if($errors->has('roleName'))
                                        <span class="help-block">{{ $errors->first('roleName') }}</span>
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
                    <div class="col-md-12 accordion">
                    <?php $counter = 1; ?>
                        @foreach($resources as $resource => $resources)
                        <div id="accordion" role="tablist" aria-multiselectable="true" class="accordion-header">
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-{{ $counter }}">
                              <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{ $counter }}" aria-expanded="false" aria-controls="collapseTwo-{{ $counter }}">
                                  {{ $resource }}
                                </a>
                              </h5>
                            </div>
                            <div id="collapseTwo-{{ $counter }}" class="collapse" role="tabpanel" aria-labelledby="heading-{{ $counter }}">
                              <div class="card-block accordion-child">
                                @foreach($resources as $privilege)
                                <?php
                                    $access = !empty(old('privileges')) ? !empty(old('privileges')[$resource][$privilege]) : $model->canAccess($resource, $privilege);
                                ?>
                                <div class="form-group {{ $errors->has('privilege') ? 'has-error' : '' }}">
                                    <div class="col-sm-offset-1 col-sm-11">
                                        <div class="checkbox checkbox-primary">
                                            <input id="privileges-{{ $resource }}-{{ $privilege }}" type="checkbox" name="privileges[{{ $resource }}][{{ $privilege }}]" value="1" {{ $access ? 'checked' : '' }}> 
                                            <label for="privileges-{{ $resource }}-{{ $privilege }}">
                                            {{ ucfirst($privilege) }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php $counter++; ?>
                    @endforeach
                    </div>
                    <div class="col-sm-12 data-table-toolbar text-right" style="padding-top: 10px;">
                        <div class="form-group">
                            <a href="{{ url('master-role') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
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
            $('.collapse').collapse();
            });
    </script>
@endsection
