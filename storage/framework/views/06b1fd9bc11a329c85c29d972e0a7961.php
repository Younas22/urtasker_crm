
<?php $__env->startSection('content'); ?>


    <section>

        <div class="container-fluid"><span id="general_result"></span></div>


        <div class="container-fluid">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('store-deposit')): ?>
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i
                            class="fa fa-plus"></i> <?php echo e(__('Add Deposit')); ?></button>
            <?php endif; ?>
        </div>


        <div class="table-responsive">
            <table id="deposit-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Account')); ?></th>
                    <th><?php echo e(trans('file.Payer')); ?></th>
                    <?php if(config('variable.currency_format')=='suffix'): ?>
                        <th><?php echo e(trans('file.Amount')); ?> (<?php echo e(config('variable.currency')); ?>)</th>
                    <?php else: ?>
                        <th>(<?php echo e(config('variable.currency')); ?>) <?php echo e(trans('file.Amount')); ?></th>
                    <?php endif; ?>
                    <th><?php echo e(trans('file.Category')); ?></th>
                    <th><?php echo e(__('Reference No')); ?></th>
                    <th><?php echo e(trans('file.Payment')); ?></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
                </thead>

            </table>
        </div>
    </section>

    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Deposit')); ?></h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Account')); ?>*</label>
                                    <select name="account_id" id="account_id" class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='<?php echo e(__('Selecting',['key'=>trans('file.Account')])); ?>...'>
                                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(trans('file.category')); ?> *</label>
                                <select name="deposit_category_id" id="deposit_category_id" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="contains"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Category')])); ?>...'>
                                    <?php $__currentLoopData = $depositCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <?php if(config('variable.currency_format')=='suffix'): ?>
                                    <label><?php echo e(trans('file.Amount')); ?> (<?php echo e(config('variable.currency')); ?>) *</label>
                                <?php else: ?>
                                    <label>(<?php echo e(config('variable.currency')); ?>) <?php echo e(trans('file.Amount')); ?> *</label>
                                <?php endif; ?>
                                <input type="text" name="amount" id="amount" required class="form-control"
                                       placeholder="<?php echo e(trans('file.Amount')); ?>">
                            </div>


                            <div class="col-md-6 form-group">
                                <label><?php echo e(trans('file.Date')); ?> *</label>
                                <input type="text" name="deposit_date" id="deposit_date" required
                                       class="form-control date"
                                       autocomplete="off"
                                       value="">
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(__('Payment Mode')); ?> </label>
                                    <select name="payment_method_id" id="payment_method_id"
                                            class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='<?php echo e(__('Selecting',['key'=>__('Payment Mode')])); ?>...'>
                                        <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($payment_method->id); ?>"><?php echo e($payment_method->method_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Payer')); ?> </label>
                                    <select name="payer_id" id="payer_id"  class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='<?php echo e(__('Selecting',['key'=>trans('file.Payer')])); ?>...'>
                                        <?php $__currentLoopData = $payers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($payer->id); ?>"><?php echo e($payer->payer_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Reference No')); ?> *</label>
                                <input type="text" name="deposit_reference" id="deposit_reference" required
                                       class="form-control"
                                       placeholder="<?php echo e(__('Reference No')); ?>">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Description')); ?></label>
                                    <textarea class="form-control" id="description" name="description"
                                              rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(trans('file.Attach')); ?> <?php echo e(trans('file.File')); ?></label>
                                <input type="file" name="deposit_file" id="deposit_file" class="form-control"
                                       placeholder=<?php echo e(trans("file.Optional")); ?>>
                                <span id="stored_file"></span>
                            </div>


                            <div class="container">
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action"/>
                                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                                    <input type="hidden" name="hidden_amount" id="hidden_amount"/>
                                    <input type="hidden" name="hidden_account_id" id="hidden_account_id"/>
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                           value=<?php echo e(trans('file.Add')); ?>>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deposit_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo e(__('Deposit Info')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table  table-bordered">

                                    <tr>
                                        <th><?php echo e(trans('file.Account')); ?></th>
                                        <td id="account_id_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(trans('file.Category')); ?></th>
                                        <td id="category_show"></td>
                                    </tr>

                                    <tr>
                                        <?php if(config('variable.currency_format')=='suffix'): ?>
                                            <th><?php echo e(trans('file.Amount')); ?> (<?php echo e(config('variable.currency')); ?>)</th>
                                        <?php else: ?>
                                            <th>(<?php echo e(config('variable.currency')); ?>) <?php echo e(trans('file.Amount')); ?></th>
                                        <?php endif; ?>
                                        <td id="amount_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(__('Deposit Date')); ?></th>
                                        <td id="deposit_date_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(__('Payment Mode')); ?></th>
                                        <td id="payment_method_id_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(trans('file.Payer')); ?></th>
                                        <td id="payer_id_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(__('Reference No')); ?></th>
                                        <td id="deposit_reference_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(trans('file.Description')); ?></th>
                                        <td id="description_show"></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo e(trans('file.Deposit')); ?> <?php echo e(trans('file.File')); ?></th>
                                        <td id="deposit_file_show"></td>
                                    </tr>


                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('file.Close')); ?></button>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><?php echo e(trans('file.Confirmation')); ?></h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center"><?php echo e(__('Are you sure you want to remove this data?')); ?></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger"><?php echo e(trans('file.OK')); ?>'
                    </button>
                    <button type="button" class="close btn-default"
                            data-dismiss="modal"><?php echo e(trans('file.Cancel')); ?></button>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($) {

        "use strict";

        $(document).ready(function () {

            var date = $('.date');
            date.datepicker({
                format: '<?php echo e(env('Date_Format_JS')); ?>',
                autoclose: true,
                todayHighlight: true
            });


            var table_table = $('#deposit-table').DataTable({
                initComplete: function () {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                            $('select').selectpicker('refresh');
                        });
                    });
                },
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('deposit.index')); ?>",
                },

                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'account',
                        name: 'account',
                    },
                    {
                        data: 'payer',
                        name: 'payer',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        render: function (data) {
                            if ('<?php echo e(config('variable.currency_format') =='suffix'); ?>') {
                                return data + ' <?php echo e(config('variable.currency')); ?>';
                            } else {
                                return '<?php echo e(config('variable.currency')); ?> ' + data;

                            }
                        }
                    },
                    {
                        data: 'category',
                        name: 'category',

                    },
                    {
                        data: 'deposit_reference',
                        name: 'deposit_reference',
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method',
                    },
                    {
                        data: 'deposit_date',
                        name: 'deposit_date',

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],


                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ <?php echo e(__("records per page")); ?>',
                    "info": '<?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)',
                    "search": '<?php echo e(trans("file.Search")); ?>',
                    'paginate': {
                        'previous': '<?php echo e(trans("file.Previous")); ?>',
                        'next': '<?php echo e(trans("file.Next")); ?>'
                    }
                },
                'columnDefs': [
                    {
                        "orderable": false,
                        'targets': [0, 8],
                    },
                    {
                        'render': function (data, type, row, meta) {
                            if (type == 'display') {
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                        },
                        'targets': [0]
                    }
                ],


                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: '<"row"lfB>rtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });
            new $.fn.dataTable.FixedHeader(table_table);
        });


        $('#create_record').on('click', function () {

            $('.modal-title').text('<?php echo e(__('Add Deposit')); ?>');
            $('#stored_file').html('');
            $('#action_button').val('<?php echo e(trans("file.Add")); ?>');
            $('#action').val('<?php echo e(trans("file.Add")); ?>');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == '<?php echo e(trans('file.Add')); ?>') {

                $.ajax({
                    url: "<?php echo e(route('deposit.store')); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        console.log(data);

                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.error) {
                            html = '<div class="alert alert-danger">' + data.error + '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('select').selectpicker('refresh');
                            $('.date').datepicker('update');
                            $('#deposit-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                })
            }

            if ($('#action').val() == '<?php echo e(trans('file.Edit')); ?>') {
                $.ajax({
                    url: "<?php echo e(route('deposit.update')); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.error) {
                            html = '<div class="alert alert-danger">' + data.error + '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('.date').datepicker('update');
                                $('select').selectpicker('refresh');
                                $('#deposit-table').DataTable().ajax.reload();
                                $('#sample_form')[0].reset();
                            }, 2000);

                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                });
            }
        });

        $(document).on('click', '.show_new', function () {

            var id = $(this).attr('id');
            $('#form_result').html('');

            var target = '<?php echo e(route('deposit.index')); ?>/' + id;

            $.ajax({
                url: target,
                dataType: "json",
                success: function (result) {
                    let id = result.data.id;
                    $('#description_show').html(result.data.description);
                    $('#account_id_show').html(result.account_name);
                    $('#payer_id_show').html(result.payer_name);
                    $('#payment_method_id_show').html(result.payment_name);
                    $('#deposit_date_show').html(result.deposit_date_name);
                    $('#amount_show').html(result.data.amount);
                    $('#category_show').html(result.deposit_category.name);
                    $('#deposit_reference_show').html(result.data.deposit_reference);
                    if (result.data.deposit_file) {
                        let d_link = '<?php echo e(route('deposit.download')); ?>/' + id;
                        $('#deposit_file_show').html('<a href="' + d_link + '"><strong><?php echo e(__('Download')); ?></strong></a>');
                    }

                    $('#deposit_modal').modal('show');
                    $('.modal-title').text("<?php echo e(__('Deposit Info')); ?>");
                }
            });
        });


        $(document).on('click', '.edit', function () {

            var id = $(this).attr('id');
            $('#form_result').html('');

            var target = "<?php echo e(route('deposit.index')); ?>/" + id + '/edit';


            $.ajax({
                url: target,
                dataType: "json",
                success: function (html) {

                    let id = html.data.id;

                    $('#description').val(html.data.description);
                    $('#deposit_date').val(html.data.deposit_date);
                    $('#amount').val(html.data.amount);
                    $('#deposit_category_id').selectpicker('val', html.data.deposit_category_id);
                    $('#account_id').selectpicker('val', html.data.account_id);
                    $('#payer_id').selectpicker('val', html.data.payer_id);
                    $('#payment_method_id').selectpicker('val', html.data.payment_method_id);
                    $('#deposit_reference').val(html.data.deposit_reference);

                    if (html.data.deposit_file) {
                        let d_link = '<?php echo e(route('deposit.download')); ?>/' + id;
                        $('#stored_file').html('<a href="' + d_link + '"><strong><?php echo e(__('Download')); ?></strong></a>');
                    }

                    $('#hidden_id').val(html.data.id);
                    $('#hidden_amount').val(html.data.amount);
                    $('#hidden_account_id').val(html.data.account_id);
                    $('.modal-title').text('<?php echo e(trans('file.Edit')); ?>');
                    $('#action_button').val('<?php echo e(trans('file.Edit')); ?>');
                    $('#action').val('<?php echo e(trans('file.Edit')); ?>');
                    $('#formModal').modal('show');
                }
            })
        });


        let delete_id;

        $(document).on('click', '.delete', function () {
            delete_id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('.modal-title').text('<?php echo e(__('DELETE Record')); ?>');
            $('#ok_button').text('<?php echo e(trans('file.OK')); ?>');

        });


        $('.close').on('click', function () {
            $('#sample_form')[0].reset();
            $('select').selectpicker('refresh');
            $('.date').datepicker('update');
            $('#deposit-table').DataTable().ajax.reload();
        });

        $('#ok_button').on('click', function () {
            let target = "<?php echo e(route('deposit.index')); ?>/" + delete_id + '/delete';
            $.ajax({
                url: target,
                beforeSend: function () {
                    $('#ok_button').text('<?php echo e(trans('file.Deleting...')); ?>');
                },
                success: function (data) {
                    let html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    setTimeout(function () {
                        $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        $('#confirmModal').modal('hide');
                        $('#deposit-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

    })(jQuery);
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\urtasker\resources\views/finance/deposit/index.blade.php ENDPATH**/ ?>