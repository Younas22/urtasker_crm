
<?php $__env->startSection('content'); ?>

    <section>

        <div class="container-fluid mb-3">
            <h2><?php echo e(__('Account Balances')); ?></h2>
        </div>


        <div class="table-responsive">
            <table id="account_balance-table" class="table ">
                <thead>
                <tr>
                    <th><?php echo e(trans('file.Account')); ?></th>
                    <?php if(config('variable.currency_format')=='suffix'): ?>
                        <th><?php echo e(trans('file.Balance')); ?> (<?php echo e(config('variable.currency')); ?>)</th>
                    <?php else: ?>
                        <th>(<?php echo e(config('variable.currency')); ?>) <?php echo e(trans('file.Balance')); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <?php if(config('variable.currency_format')=='suffix'): ?>
                        <th><?php echo e(trans('file.Total')); ?> (<?php echo e(config('variable.currency')); ?>)</th>
                    <?php else: ?>
                        <th>(<?php echo e(config('variable.currency')); ?>) <?php echo e(trans('file.Total')); ?></th>
                    <?php endif; ?>
                    <th></th>
                </tr>
                </tfoot>

            </table>
        </div>
    </section>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($) {
        "use strict";
        let total;
        let pageTotal;


        $(document).ready(function() {


            $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
            $("ul#hrm").addClass("show");
            $("ul#hrm #Finance").addClass("active");


         let  table = $('#account_balance-table').DataTable({

             "footerCallback": function ( row, data, start, end, display ) {
                 var api = this.api(), data;

                 // Remove the formatting to get integer data for summation
                 var intVal = function ( i ) {
                     return typeof i == 'string' ?
                         i.replace(/[\$,]/g, '')*1 :
                         typeof i == 'number' ?
                             i : 0;
                 };

                 // Total over all pages
                 total = api
                     .column( 1 )
                     .data()
                     .reduce( function (a, b) {
                         return intVal(a) + intVal(b);
                     }, 0 );

                 // Total over this page
                 pageTotal = api
                     .column( 1, { page: 'current'} )
                     .data()
                     .reduce( function (a, b) {
                         return intVal(a) + intVal(b);
                     }, 0 );

                 // Update footer
                 $( api.column( 1 ).footer() ).html(
                     +pageTotal +' ('+ total +' <?php echo e(trans('file.Total')); ?>)'
                 );
             },

                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('account_balances')); ?>",
                },

                columns: [
                    {
                        data: 'account_name',
                        name: 'account_name',
                    },
                    {
                        data: 'account_balance',
                        name: 'account_balance',
                    },
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
                        'targets': [0, 1],
                    }

                ],
                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
            });
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\urtasker\resources\views/finance/account_balance/index.blade.php ENDPATH**/ ?>