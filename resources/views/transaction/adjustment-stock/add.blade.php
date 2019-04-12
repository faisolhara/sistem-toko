@extends('layouts.master')

@section('title', trans('menu.adjustment-stock'))

@section('header')
@parent
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('plugins/switchery/switchery.min.css') }}">

@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h4 class="m-t-0 header-title"><b>{{ $title.' '.trans('menu.adjustment-stock') }} <User></User></b></h4>
            <form class="form-horizontal" role="form" method="post" action="{{ route('adjustment-stock-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-20">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#header" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">{{ trans('fields.header') }}</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#lines" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                        <span class="hidden-xs">{{ trans('fields.item') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="header">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" id="id" class="form-control" value="{{ count($errors) > 0 ? old('id') : $model->adjustment_stock_header_id }}">
                                        <div class="form-group {{ $errors->has('adjustmentNumber') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.adjustment-number') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" name="adjustmentNumber" class="form-control" value="{{ count($errors) > 0 ? old('adjustmentNumber') : $model->adjustment_stock_number }}" readonly>
                                                @if($errors->has('adjustmentNumber'))
                                                    <span class="help-block">{{ $errors->first('adjustmentNumber') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <?php
                                            $adjustmentDate = new \DateTime($model->adjustment_date);
                                        ?>
                                        <div class="form-group {{ $errors->has('adjustmentDate') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.adjustment-date') }} *</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input name="adjustmentDate" id="adjustmentDate" type="text" class="form-control datepicker-autoclose" style="position: relative; z-index: 100000;" value="{{ $adjustmentDate !== null ? $adjustmentDate->format('d-m-Y') : '' }}" {{ !empty($model->adjustment_stock_header_id) ? 'disabled' : '' }}>
                                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                </div>
                                                @if($errors->has('adjustmentDate'))
                                                    <span class="help-block">{{ $errors->first('adjustmentDate') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('adjustmentType') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.uom') }} *</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="adjustmentType" name="adjustmentType" {{ !empty($model->adjustment_stock_header_id) ? 'disabled' : '' }}>
                                                <?php $adjustmentType = count($errors) > 0 ? old('adjustmentType') : $model->adjustment_type; ?>
                                                    <option value="">{{ trans('fields.please-select') }}</option>
                                                @foreach($adjustmentOptions as $adjustment)
                                                    <option value="{{ $adjustment }}" {{ $adjustment == $adjustmentType ? 'selected' : '' }}>{{ $adjustment }}</option>
                                                @endforeach
                                                </select>
                                                @if($errors->has('adjustmentType'))
                                                    <span class="help-block">{{ $errors->first('adjustmentType') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.reason') }} *</label>
                                            <div class="col-md-8">
                                                <textarea name="reason" id="reason" class="form-control" rows="5" {{ !empty($model->adjustment_stock_header_id) ? 'disabled' : '' }}>{{ count($errors) > 0 ? old('reason') : $model->reason }}</textarea>
                                                @if($errors->has('reason'))
                                                    <span class="help-block">{{ $errors->first('reason') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('descriptionHeader') ? 'has-error' : '' }}">
                                            <label class="col-md-4 control-label">{{ trans('fields.description') }} </label>
                                            <div class="col-md-8">
                                                <textarea name="descriptionHeader" id="descriptionHeader" class="form-control" rows="5" {{ !empty($model->adjustment_stock_header_id) ? 'disabled' : '' }}>{{ count($errors) > 0 ? old('descriptionHeader') : $model->description }}</textarea>
                                                @if($errors->has('descriptionHeader'))
                                                    <span class="help-block">{{ $errors->first('descriptionHeader') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="lines">
                                    @if(empty($model->adjustment_stock_header_id))
                                    <div class="col-sm-12 data-table-toolbar text-right">
                                        <div class="form-group">
                                            <button id="add-detail-action" type="button" class="btn btn-primary waves-effect waves-light btn-sm" data-toggle="modal" ><i class="fa fa-plus-circle"></i> {{ trans('fields.add') }} {{ trans('fields.item') }}</button>
                                        </div>
                                    </div>
                                    @endif
                                    <table class="table table-bordered table-hover table-striped m-0" id="table-detail" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="30%" class="text-center">{{ trans('fields.item') }}</th>
                                                <th width="30%" class="text-center">{{ trans('fields.uom') }}</th>
                                                <th width="10%" class="text-center">{{ trans('fields.quantity') }}</th>
                                                <th width="15%" class="text-center">{{ trans('fields.price') }}</th>
                                                <th width="15%" class="text-center">{{ trans('fields.total-price') }}</th>
                                                <th width="25%" class="text-center">{{ trans('fields.description') }}</th>
                                                <th style="min-width:100px;">{{ trans('fields.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $indexDetail = 0; ?>
                                            @if(count($errors) > 0)
                                            @for($i = 0; $i < count(old('itemId', [])); $i++)
                                            <?php
                                            $itemCode = '';
                                            $itemName = '';
                                            foreach ($itemOptions as $item) {
                                                if (old('itemId')[$i] == $item->item_id) {
                                                    $itemCode = $item->item_code;
                                                    $itemName = $item->item_name;
                                                }
                                            }
                                            $uomCode = '';
                                            foreach ($uomOptions as $uom) {
                                                if (old('uomId')[$i] == $uom->uom_id) {
                                                    $uomCode = $uom->uom_code;
                                                }
                                            }
                                            ?>
                                            <tr data-index="{{ $indexDetail }}">
                                                <td>{{ $itemCode.' - '.$itemName }}</td>
                                                <td class="text-right">{{ $uomCode }}</td>
                                                <td class="text-right">{{ old('adjustmentQuantity')[$i] }}</td>
                                                <td class="text-right">{{ old('price')[$i] }}</td>
                                                <td class="text-right">{{ old('totalPrice')[$i] }}</td>
                                                <td class="text-right">{{ old('description')[$i] }}</td>
                                                <input type="hidden" name="idDetail[]" value="{{ old('idDetail')[$i] }}">
                                                <input type="hidden" name="itemId[]" value="{{ old('itemId')[$i] }}">
                                                <input type="hidden" name="uomId[]" value="{{ old('uomId')[$i] }}">
                                                <input type="hidden" name="uomCode[]" value="{{ old('uomCode')[$i] }}">
                                                <input type="hidden" name="adjustmentQuantity[]" value="{{ old('adjustmentQuantity')[$i] }}">
                                                <input type="hidden" name="price[]" value="{{ old('price')[$i] }}">
                                                <input type="hidden" name="totalPrice[]" value="{{ old('totalPrice')[$i] }}">
                                                <input type="hidden" name="description[]" value="{{ old('description')[$i] }}">
                                                <td class="text-center">
                                                @if(empty($model->adjustment_stock_header_id))
                                                    <a data-toggle="tooltip" class="btn btn-warning btn-xs edit-detail" ><i class="fa fa-pencil"></i></a>
                                                    <a data-toggle="tooltip" class="btn btn-danger btn-xs delete-detail" ><i class="fa fa-remove"></i></a>
                                                @endif
                                                </td>
                                            </tr>
                                            <?php $indexDetail++; ?>
                                            @endfor
                                            @else
                                            @foreach($model->lines as $line)
                                            <tr data-index="{{ $indexDetail }}">
                                                <td>{{ $line->item->item_code.' - '.$line->item->item_name }}</td>
                                                <td>{{ !empty($line->uom) ? $line->uom->uom_code : '' }}</td>
                                                <td class="text-right">{{  number_format($line->adjustment_quantity) }}</td>
                                                <td class="text-right">{{  number_format($line->price) }}</td>
                                                <td class="text-right">{{  number_format($line->adjustment_quantity * $line->price) }}</td>
                                                <td>{{ $line->description }}</td>
                                                <input type="hidden" name="idDetail[]" value="{{ $line->adjustment_stock_line_id }}">
                                                <input type="hidden" name="itemId[]" value="{{ $line->item->item_id }}">
                                                <input type="hidden" name="uomId[]" value="{{ $line->uom->uom_id }}">
                                                <input type="hidden" name="uomCode[]" value="{{ $line->uom->uom_code }}">
                                                <input type="hidden" name="adjustmentQuantity[]" value="{{ number_format($line->adjustment_quantity) }}">
                                                <input type="hidden" name="price[]" value="{{ number_format($line->price) }}">
                                                <input type="hidden" name="totalPrice[]" value="{{ number_format($line->adjustment_quantity * $line->total_price) }}">
                                                <input type="hidden" name="description[]" value="{{ $line->description }}">
                                                <td class="text-center">
                                                @if(empty($model->adjustment_stock_header_id))
                                                    <a data-toggle="tooltip" class="btn btn-xs btn-warning edit-detail"><i class="fa fa-pencil"></i></a>
                                                    <a data-toggle="tooltip" class="btn btn-danger btn-xs delete-detail" ><i class="fa fa-remove"></i></a>
                                                @endif
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
                            <a href="{{ url('adjustment-stock') }}" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> {{ trans('fields.cancel') }}</a>
                            @if(empty($model->adjustment_stock_header_id))
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> {{ trans('fields.save') }}</button>
                            @endif
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
    <div id="myModal" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <div class="form-group {{ $errors->has('itemId') ? 'has-error' : '' }}">
                                            <label for="itemId" class="col-sm-4 control-label">{{ trans('fields.item') }} <span class="required">*</span></label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" id="itemId" name="itemId">
                                                    <option value="">{{ trans('fields.please-select') }}</option>
                                                    @foreach($itemOptions as $option)
                                                    <option value="{{ $option->item_id }}">{{ $option->item_code.' - '.$option->item_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('uomId') ? 'has-error' : '' }}">
                                            <label for="uomId" class="col-sm-4 control-label">{{ trans('fields.uom') }} <span class="required">*</span></label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="uomId" name="uomId">
                                                    <option value="">{{ trans('fields.please-select') }}</option>
                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('adjustmentQuantity') ? 'has-error' : '' }}">
                                            <label for="adjustmentQuantity" class="col-sm-4 control-label">{{ trans('fields.quantity') }} *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control currency text-right autonumber" data-a-sep="." data-a-dec="," id="adjustmentQuantity" name="adjustmentQuantity" value="">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                            <label for="price" class="col-sm-4 control-label" >{{ trans('fields.price') }} *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control currency text-right autonumber text-right" data-a-sep="." data-a-dec="," id="price" name="price" value="">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('totalPrice') ? 'has-error' : '' }}">
                                            <label for="totalPrice" class="col-sm-4 control-label">{{ trans('fields.total-price') }}</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control currency text-right autonumber" data-a-sep="." data-a-dec="," id="totalPrice" name="totalPrice" value="" readonly>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label for="description" class="col-sm-4 control-label">{{ trans('fields.description') }}</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="description" name="description" value="">
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
                        <span id="submit-modal-detail">{{ trans('fields.add') }}</span> {{ trans('fields.item') }}
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endsection

@section('addScript')
<script src="{{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('plugins/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<!-- Init Js file -->
<script type="text/javascript" src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>
<script src="{{ asset('plugins/autoNumeric/autoNumeric.js') }}" type="text/javascript"></script>

@endsection

@section('script')
<script type="text/javascript">
jQuery(function($) {
    $('.autonumber').autoNumeric('init', {mDec: 0});
});
var indexDetail = {{ $indexDetail }};
$(document).on('ready', function(){

    $('#itemId').on('change',function(){
        updateUomOption();
    });

    $('#price').on('keyup',function(){
        changeTotalPrice();
    });

    $('#adjustmentQuantity').on('keyup',function(){
        changeTotalPrice();
    });

    $('#add-detail-action').on('click', function(){
        clearFormDetail();
        $('#title-modal-detail').html('{{ trans('fields.add') }}');
        $('#submit-modal-detail').html('{{ trans('fields.add') }}');
        $('#myModal').modal('show');

    });

    $('#add-detail').on('click', function() {
        var indexDetailForm       = $('#indexDetailForm').val();
        var actionDetail          = $('#actionDetail').val();
        var idDetail              = $('#idDetail').val();
        var itemId                = $('#itemId').val();
        var itemIdLabel           = $('#itemId option:selected').text();
        var uomId                 = $('#uomId').val();
        var uomIdLabel            = $('#uomId option:selected').text();
        var price                 = $('#price').val();
        var adjustmentQuantity       = $('#adjustmentQuantity').val();
        var totalPrice            = $('#totalPrice').val();
        var description           = $('#description').val();
        var error = false;

        if(checkItemExist(itemId) && actionDetail != 'edit'){
            $('#modal-alert').find('.alert-message').html('{{ trans('message.item-exist') }}');
            $('#modal-alert').modal('show');
            return;
        }
        $('#actionDetail').val('add');

        if (itemId == '' || itemId <= 0) {
            $('#itemId').parent().parent().addClass('has-error');
            $('#itemId').parent().find('span.help-block').html('Item is required');
            error = true;
        } else {
            $('#itemId').parent().parent().removeClass('has-error');
            $('#itemId').parent().find('span.help-block').html('');
        }

        if (uomId == '' || uomId <= 0) {
            $('#uomId').parent().parent().addClass('has-error');
            $('#uomId').parent().find('span.help-block').html('uom is required');
            error = true;
        } else {
            $('#uomId').parent().parent().removeClass('has-error');
            $('#uomId').parent().find('span.help-block').html('');
        }

        if (adjustmentQuantity == '' || adjustmentQuantity <= 0) {
            $('#adjustmentQuantity').parent().parent().addClass('has-error');
            $('#adjustmentQuantity').parent().find('span.help-block').html('Item is required');
            error = true;
        } else {
            $('#adjustmentQuantity').parent().parent().removeClass('has-error');
            $('#adjustmentQuantity').parent().find('span.help-block').html('');
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

        var htmlTr = '<td >' + itemIdLabel + '</td>' +
        '<td class="text-right">' + uomIdLabel + '</td>' +
        '<td class="text-right">' + adjustmentQuantity + '</td>' +
        '<td class="text-right">' + price + '</td>' +
        '<td class="text-right">' + totalPrice + '</td>' +
        '<td >' + description + '</td>' +
        '<td class="text-center">' +
        '<a data-toggle="tooltip" class="btn btn-xs btn-warning edit-detail" ><i class="fa fa-pencil"></i></a> ' +
        '<a data-toggle="tooltip" class="btn btn-danger btn-xs delete-detail" ><i class="fa fa-remove"></i></a>' +
        '<input type="hidden" name="idDetail[]" value="' + idDetail + '">'+
        ' <input type="hidden" name="itemId[]" value="' + itemId + '">' +
        ' <input type="hidden" name ="uomId[]" value="' + uomId + '">' +
        ' <input type="hidden" name ="uomCode[]" value="' + uomIdLabel + '">' +
        ' <input type="hidden" name="adjustmentQuantity[]" value="' + adjustmentQuantity + '">' +
        ' <input type="hidden" name="price[]" value="' + price + '">' +
        ' <input type="hidden" name="totalPrice[]" value="' + totalPrice + '">' +
        ' <input type="hidden" name="description[]" value="' + description + '">' +
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

var changeTotalPrice = function(){
    price = $('#price').autoNumeric('get');
    adjustmentQuantity = $('#adjustmentQuantity').autoNumeric('get');

    totalPrice = price * adjustmentQuantity;

    $('#totalPrice').val(totalPrice);
    $('#totalPrice').autoNumeric('update', {mDec: 0});
}
var updateUomOption = function(){
    var itemId = $('#itemId').val();
    $.ajax({
        url: '{{URL("/api/get-uom-by-item")}}',
        data: {itemId: itemId},
        success: function( data ) {
            $('#uomId').html('');
            $('#uomId').append(
                '<option value="">{{ trans("fields.please-select") }}</option>'
            );
            data.forEach(function(item) {
                $('#uomId').append(
                    '<option value="'+ item.uom_id +'">'+ item.uom_code +'</option>'
                );
            });
        }
    });
};

var checkItemExist = function(itemIdAdd) {
    var exist = false;
    $('#table-detail tbody tr').each(function (i, row) {
        var itemId = $(row).find('[name="itemId[]"]').val();
        if (itemId == itemIdAdd) {
            exist = true;
        }
    });
    return exist;
};

var clearFormDetail = function() {
    $('#indexDetailForm').val('');
    $('#idDetail').val('');
    $('#itemId').val('').change();
    $('#uomId').val('').change();
    $('#adjustmentQuantity').val('');
    $('#price').val('');
    $('#totalPrice').val('');
    $('#description').val('');
};

var editDetail = function() {
    var indexDetailForm       = $(this).parent().parent().data('index');
    var idDetail              = $(this).parent().parent().find('[name="idDetail[]"]').val();
    var itemId                = $(this).parent().parent().find('[name="itemId[]"]').val();
    var uomId                 = $(this).parent().parent().find('[name="uomId[]"]').val();
    var uomCode               = $(this).parent().parent().find('[name="uomCode[]"]').val();
    var adjustmentQuantity       = $(this).parent().parent().find('[name="adjustmentQuantity[]"]').val();
    var price                 = $(this).parent().parent().find('[name="price[]"]').val();
    var totalPrice            = $(this).parent().parent().find('[name="totalPrice[]"]').val();
    var description           = $(this).parent().parent().find('[name="description[]"]').val();

    $('#indexDetailForm').val(indexDetailForm);
    $('#idDetail').val(idDetail);
    $('#itemId').val(itemId).change();
    $('#uomId').html('');
    $('#uomId').append(
        '<option value="'+ uomId +'">'+ uomCode +'</option>'
    );
    $('#uomId').val(uomId).change();
    $('#adjustmentQuantity').val(adjustmentQuantity);
    $('#price').val(price);
    $('#totalPrice').val(totalPrice);
    $('#description').val(description);

    $('#title-modal-detail').html('{{ trans('fields.edit') }}');
    $('#submit-modal-detail').html('{{ trans('fields.edit') }}');

    $('#actionDetail').val('edit');

    $('#myModal').modal('show');
};
</script>

@endsection