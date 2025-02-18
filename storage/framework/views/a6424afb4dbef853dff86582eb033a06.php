<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-body">
            <h3 class="card-title"><?php echo e(__('Add Loan Type')); ?></h3>
            <form method="post" id="loan_type_form" class="form-horizontal" >
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <input type="text" name="loan_type_name" class="form-control" placeholder="<?php echo e(__('Loan Type')); ?>">
                    <input type="submit" id="loan_type_submit" class="btn btn-success" value=<?php echo e(trans("file.Save")); ?>>
                </div>
            </form>
        </div>
    </div>
</div>

<span class="loan_type_result"></span>
<div class="table-responsive">
    <table id="loan_type-table" class="table ">
        <thead>
        <tr>
            <th><?php echo e(__('Type name')); ?></th>
            <th class="not-exported"><?php echo e(trans('file.Action')); ?></th>
        </tr>
        </thead>

    </table>
</div>


<div id="LoanTypeEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(trans('file.Edit')); ?></h5>

                <button type="button" data-dismiss="modal" id="loan_type_close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <span class="loan_type_result_edit"></span>

            <div class="modal-body">
                <form method="post" id="loan_type_form_edit" class="form-horizontal" enctype="multipart/form-data" >

                    <?php echo csrf_field(); ?>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(__('Loan Type')); ?> *</label>
                        <input type="text" name="loan_type_name_edit" id="loan_type_name_edit"  class="form-control"
                               placeholder="<?php echo e(__('Type')); ?>">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="hidden_loan_type_id" id="hidden_loan_type_id" />
                        <input type="submit" name="loan_type_edit_submit" id="loan_type_edit_submit" class="btn btn-success" value=<?php echo e(trans("file.Edit")); ?> />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\server\htdocs\urtasker\resources\views/settings/variables/partials/loan_type.blade.php ENDPATH**/ ?>