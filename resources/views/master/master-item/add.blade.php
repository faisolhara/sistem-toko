@extends('layouts.master')

@section('title', trans('menu.master-item'))

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ $title.' '.trans('menu.master-item') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('master-item-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#header" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">{{ trans('fields.item') }}</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#lines" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                        <span class="hidden-xs">{{ trans('fields.price') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="header">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->item_id }}">
                                        <div class="form-group {{ $errors->has('itemCode') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.item-code') }} *</label>
                                            <div class="col-md-8">
                                                <input type="text" name="itemCode" class="form-control" value="{{ count($errors) > 0 ? old('itemCode') : $model->item_code }}">
                                                @if($errors->has('itemCode'))
                                                    <span class="help-block">{{ $errors->first('itemCode') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('itemName') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.name') }} *</label>
                                            <div class="col-md-8">
                                                <input type="text" name="itemName" class="form-control" value="{{ count($errors) > 0 ? old('itemName') : $model->item_name }}">
                                                @if($errors->has('itemName'))
                                                    <span class="help-block">{{ $errors->first('itemName') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('barcode') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.barcode') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" name="barcode" class="form-control" value="{{ count($errors) > 0 ? old('barcode') : $model->barcode }}">
                                                @if($errors->has('barcode'))
                                                    <span class="help-block">{{ $errors->first('barcode') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.description') }} </label>
                                            <div class="col-md-8">
                                                <input type="text" name="description" class="form-control" value="{{ count($errors) > 0 ? old('description') : $model->description }}">
                                                @if($errors->has('description'))
                                                    <span class="help-block">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('uomIdHeader') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.uom') }} *</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="uomIdHeader" name="uomIdHeader">
                                                <?php $uomIdHeader = count($errors) > 0 ? old('uomIdHeader') : $model->uom_id; ?>
                                                    <option value="">{{ trans('fields.please-select') }}</option>
                                                @foreach($uomOptions as $uom)
                                                    <option value="{{ $uom->uom_id }}" {{ $uom->uom_id == $uomIdHeader ? 'selected' : '' }}>{{ $uom->uom_name }}</option>
                                                @endforeach
                                                </select>
                                                @if($errors->has('uomIdHeader'))
                                                    <span class="help-block">{{ $errors->first('uomIdHeader') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('categoryId') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.category') }} *</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="categoryId" name="categoryId">
                                                <?php $categoryId = count($errors) > 0 ? old('categoryId') : $model->category_id; ?>
                                                    <option value="">{{ trans('fields.please-select') }}</option>
                                                @foreach($categoryOptions as $category)
                                                    <option value="{{ $category->category_id }}" {{ $category->category_id == $categoryId ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                @endforeach
                                                </select>
                                                @if($errors->has('categoryId'))
                                                    <span class="help-block">{{ $errors->first('categoryId') }}</span>
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
                                <div class="tab-pane" id="lines">
                                    <div class="col-sm-12 data-table-toolbar text-right">
                                        <div class="form-group">
                                            <button id="add-detail-action" type="button" class="btn btn-primary waves-effect waves-light btn-sm" data-toggle="modal" ><i class="fa fa-plus-circle"></i> {{ trans('fields.add') }} {{ trans('fields.item-price') }}</button>
                                            <a id="clear-details" href="#" class="btn btn-sm btn-danger">
                                                <i class="fa fa-remove"></i> {{ trans('fields.clear') }} {{ trans('fields.item-price') }}
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-striped m-0" id="table-detail" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="40%" class="text-center">{{ trans('fields.uom') }}</th>
                                                <th width="50%" class="text-center">{{ trans('fields.price') }}</th>
                                                <th style="min-width:30px;">{{ trans('fields.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $indexDetail = 0; ?>
                                            @if(count($errors) > 0)
                                            @for($i = 0; $i < count(old('uomId', [])); $i++)
                                            <?php
                                            $uomCode = '';
                                            foreach ($uomOptions as $uom) {
                                                if (old('uomId')[$i] == $uom->uom_id) {
                                                    $uomCode = $uom->uom_code;
                                                }
                                            }
                                            ?>
                                            <tr data-index="{{ $indexDetail }}">
                                                <td>{{ $uomCode }}</td>
                                                <td class="text-right">{{ old('price')[$i] }}</td>
                                                <input type="hidden" name="idDetail[]" value="{{ old('idDetail')[$i] }}">
                                                <input type="hidden" name="uomId[]" value="{{ old('uomId')[$i] }}">
                                                <input type="hidden" name="price[]" value="{{ old('price')[$i] }}">
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" class="btn btn-warning btn-xs edit-detail" ><i class="fa fa-pencil"></i></a>
                                                    <a data-toggle="tooltip" class="btn btn-danger btn-xs delete-detail" ><i class="fa fa-remove"></i></a>
                                                </td>
                                            </tr>
                                            <?php $indexDetail++; ?>
                                            @endfor
                                            @else
                                            @foreach($model->itemPrice()->get() as $itemPrice)
                                            <?php $uom = $itemPrice->uom; ?>
                                            <tr data-index="{{ $indexDetail }}">
                                                <td>{{ $uom !== null ? $uom->uom_code : '' }}</td>
                                                <td class="text-right">{{  number_format($itemPrice->price) }}</td>
                                                <input type="hidden" name="idDetail[]" value="{{ $itemPrice->item_price_id }}">
                                                <input type="hidden" name="uomId[]" value="{{ $itemPrice->uom_id }}">
                                                <input type="hidden" name="price[]" value="{{ number_format($itemPrice->price) }}">
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" class="btn btn-xs btn-warning edit-detail"><i class="fa fa-pencil"></i></a>
                                                    <a data-toggle="tooltip" class="btn btn-danger btn-xs delete-detail" ><i class="fa fa-remove"></i></a>
                                                </td>
                                            </tr>
                                            <?php $indexDetail++; ?>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12 data-table-toolbar text-right">
                        <div class="form-group">
                            <a href="{{ url('master-item') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
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

@section('modal')
@parent()
    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('fields.item-price') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="horizontal-form">
                                <form  role="form" id="add-form" class="form-horizontal" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="col-sm-12 portlets">
                                        <input type="hidden" name="indexDetailForm" id="indexDetailForm" value="">
                                        <input type="hidden" name="actionDetail" id="actionDetail" value="">
                                        <input type="hidden" name="idDetail" id="idDetail" value="">
                                        <div class="form-group {{ $errors->has('uomId') ? 'has-error' : '' }}">
                                            <label for="uomId" class="col-sm-4 control-label">{{ trans('fields.uom') }} <span class="required">*</span></label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="uomId" name="uomId">
                                                    <option value="">{{ trans('fields.please-select') }}</option>
                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                            <label for="price" class="col-sm-4 control-label">{{ trans('fields.price') }} *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control currency text-right" id="price" name="price" value="">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <a id="add-detail" class="btn btn-sm btn-primary">
                        <span id="submit-modal-detail">{{ trans('fields.add') }}</span> {{ trans('fields.item-price') }}
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endsection

@section('script')
@parent()
<script type="text/javascript">
var indexDetail = {{ $indexDetail }};
$(document).on('ready', function(){
    if($('#itemId').val() != ''){
        updateUomOption();
    }
    $('#uomIdHeader').on('change',function(){
        updateUomOption();
        clearDetails();
    });
    
    $('.delete-detail').on('click', function() {
        $(this).parent().parent().remove();
    });

    $('#add-detail-action').on('click', function(){
        if($('#uomIdHeader').val() == ''){
            $('#modal-alert').find('.alert-message').html('{{ trans('message.choose-uom-first') }}');
            $('#modal-alert').modal('show');
            return;
        }
        
        clearFormDetail();
        $('#title-modal-detail').html('{{ trans('fields.add') }}');
        $('#submit-modal-detail').html('{{ trans('fields.add') }}');
        $('#myModal').modal('show');

    });

    $('#add-detail').on('click', function() {
        var indexDetailForm       = $('#indexDetailForm').val();
        var actionDetail          = $('#actionDetail').val();
        var idDetail              = $('#idDetail').val();
        var uomId                 = $('#uomId').val();
        var uomIdLabel            = $('#uomId option:selected').text();
        var price                 = $('#price').val();
        var error = false;

        if(checkUomExist(uomId) && actionDetail != 'edit'){
            $('#modal-alert').find('.alert-message').html('{{ trans('message.uom-exist') }}');
            $('#modal-alert').modal('show');
            return;
        }
        $('#actionDetail').val('add');

        if (uomId == '' || uomId <= 0) {
            $('#uomId').parent().parent().addClass('has-error');
            $('#uomId').parent().find('span.help-block').html('Uom is required');
            error = true;
        } else {
            $('#uomId').parent().parent().removeClass('has-error');
            $('#uomId').parent().find('span.help-block').html('');
        }

        if (price == '' || price <= 0) {
            $('#price').parent().parent().addClass('has-error');
            $('#price').parent().find('span.help-block').html('Price is required');
            error = true;
        } else {
            $('#price').parent().parent().removeClass('has-error');
            $('#price').parent().find('span.help-block').html('');
        }

        if (error) {
            return;
        }

        var htmlTr = '<td >' + uomIdLabel + '</td>' +
        '<td class="text-right">' + price + '</td>' +
        '<td class="text-center">' +
        '<a data-toggle="tooltip" class="btn btn-xs btn-warning edit-detail" ><i class="fa fa-pencil"></i></a> ' +
        '<a data-toggle="tooltip" class="btn btn-danger btn-xs delete-detail" ><i class="fa fa-remove"></i></a>' +
        '<input type="hidden" name="idDetail[]" value="' + idDetail + '">'+
        ' <input type="hidden" name="uomId[]" value="' +uomId + '">' +
        ' <input type="hidden" name="price[]" value="' +price + '">' +
        '</td>';

        if (indexDetailForm != '') {
            $('tr[data-index="' + indexDetailForm + '"]').html(htmlTr);
            indexDetail++;
        } else {
            $('#table-detail tbody').append(
                '<tr data-index="' + indexDetail + '">' + htmlTr + '</tr>'
                );
            indexDetail++;
        }

        $('.edit-detail').on('click', editDetail);

        $('.delete-detail').on('click', function() {
            $(this).parent().parent().remove();
        });
        $('#myModal').modal('hide');
    });

    $('.edit-detail').on('click', editDetail);

    $('#clear-details').on('click', function() {
        $('#table-detail tbody').html('');
    });
});

var clearDetails = function(){
    $('#table-detail tbody').html('');
};

var updateUomOption = function(){
    var uomIdHeader = $('#uomIdHeader').val();
    $.ajax({
        url: '{{URL("/api/get-uom-item")}}',
        data: {uomId: uomIdHeader},
        success: function( data ) {
            $('#uomId').html('');
            data.forEach(function(item) {
                $('#uomId').append(
                    '<option value="'+ item.uom_id +'">'+ item.uom_code +'</option>'
                );
            });
        }
    });
};

var checkUomExist = function(uomIdAdd) {

        var exist = false;
        $('#table-detail tbody tr').each(function (i, row) {
            var uomId = $(row).find('[name="uomId[]"]').val();
            if (uomId == uomIdAdd) {
                exist = true;
            }
        });
        return exist;
    };

var clearFormDetail = function() {
    $('#indexDetailForm').val('');
    $('#idDetail').val('');
    $('#uomId').val('').change();
    $('#price').val('');
};

var editDetail = function() {
    var indexDetailForm       = $(this).parent().parent().data('index');
    var idDetail              = $(this).parent().parent().find('[name="idDetail[]"]').val();
    var uomId                 = $(this).parent().parent().find('[name="uomId[]"]').val();
    var price                 = $(this).parent().parent().find('[name="price[]"]').val();

    $('#indexDetailForm').val(indexDetailForm);
    $('#idDetail').val(idDetail);
    $('#uomId').val(uomId).change();
    $('#price').val(price);

    $('#title-modal-detail').html('{{ trans('fields.edit') }}');
    $('#submit-modal-detail').html('{{ trans('fields.edit') }}');

    $('#actionDetail').val('edit');

    $('#myModal').modal('show');

};
</script>
@endsection