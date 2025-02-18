
<?php $__env->startSection('content'); ?>


    <section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header d-flex justify-content-between">
                            <h2 class="card-title"><?php echo e(__('Payslip')); ?> <span class="text-grey text-small">(<?php echo e($payslip->month_year); ?>)</span>
                            </h2>
                            <div class="pull-right"><a href="<?php echo e(route('payslip.pdf',$payslip->payslip_key)); ?>"
                                                       class="btn btn-default btn-sm" data-toggle="tooltip"
                                                       data-placement="top" title=""
                                                       data-original-title="Download Payslip"><i
                                            class="fa fa-file-pdf-o"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between collapse-head" data-toggle="collapse"
                                 href="#collapseExample" role="button" aria-expanded="true"
                                 aria-controls="collapseExample">
                                <div>
                                    <?php if(!empty($employee->user()->profile_photo)): ?>
                                        <img class="profile-photo sm mr-1"
                                             src="<?php echo e(asset('uploads/profile_photos/')); ?>/<?php echo e($employee->user()->profile_photo); ?>">
                                    <?php else: ?>
                                        <img class="profile-photo sm mr-1"
                                             src="<?php echo e(asset('uploads/profile_photos/avatar.jpg')); ?>">
                                    <?php endif; ?>
                                    <?php echo e($employee->full_name); ?> (<?php echo e($employee->user->username ?? ''); ?>)
                                </div>
                                <small class="show btn-light btn-sm" disabled><i class="dripicons-chevron-up"></i>
                                </small>
                            </div>
                            <div class="collapse show" id="collapseExample">
                                <div class="table-responsive">
                                    <table class="table  table-bordered dataTable no-footer">
                                        <tbody>
                                        <tr>
                                            <td><strong class="help-split"><?php echo e(__('Payslip No.')); ?>

                                                    : </strong><?php echo e($payslip->id); ?></td>
                                            <td><strong class="help-split"><?php echo e(__('Joining Date')); ?>

                                                    : </strong><?php echo e($employee->joining_date); ?></td>
                                            <td><strong class="help-split"><?php echo e(trans('file.Phone')); ?>

                                                    : </strong><?php echo e($employee->contact_no); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong class="help-split"><?php echo e(trans('file.Designation')); ?>

                                                    : </strong><?php echo e($employee->designation->designation_name); ?></td>
                                            <td><strong class="help-split"><?php echo e(trans('file.Department')); ?>

                                                    : </strong><?php echo e($employee->department->department_name); ?></td>
                                            <td><strong class="help-split"><?php echo e(trans('file.Company')); ?>

                                                    : </strong><?php echo e($employee->company->company_name); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            (function ($) {
                                "use strict";
                                $('.collapse-head').on('click', function () {
                                    if ($(this).attr('aria-expanded') == "true") {
                                        $(this + ' .show').html('<i class="dripicons-chevron-down"></i>');
                                    } else {
                                        $(this + ' .show').html('<i class="dripicons-chevron-up"></i>');
                                    }
                                })
                            })(jQuery);
                        </script>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title"> <?php echo e(__('Payment Details')); ?> ( <?php echo e($payslip->payment_type); ?> ) </h3>
                        </div>
                        <div id="accordion">
                            <div class="card mb-2">
                                <div class="card-header"><a class="text-dark d-block" data-toggle="collapse"
                                                            href="#basic_salary" aria-expanded="true">
                                        <strong><?php echo e(__('Basic Salary')); ?></strong> </a></div>
                                <div id="basic_salary" class="collapse in" data-parent="#accordion"
                                     aria-expanded="true">
                                    <div class="table-responsive">
                                        <table class="table  table-bordered dataTable no-footer">
                                            <tbody>
                                            <tr>
                                                <?php if($payslip->payment_type == 'Hourly'): ?>
                                                    <td><strong><?php echo e(__('Per Hour Salary')); ?>:</strong> <span
                                                                class="pull-right"><?php echo e($payslip->basic_salary); ?></span>
                                                    </td>
                                                    <td>
                                                        <strong><?php echo e(__('Total Hours Worked This Month')); ?>:</strong><span
                                                                class="pull-right"><?php echo e($total_hours); ?></span>
                                                    </td>
                                                    <td>
                                                        <strong><?php echo e(__('Amount')); ?>:</strong><span
                                                                class="pull-right"><?php echo e($amount_hours); ?></span>
                                                    </td>
                                                <?php else: ?>
                                                    <td><strong><?php echo e(__('Basic Salary')); ?>:</strong> <span
                                                                class="pull-right"><?php echo e($payslip->basic_salary); ?></span>
                                                    </td>
                                                    <td>
                                                <?php endif; ?>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php if($payslip->allowances): ?>
                                <div class="card mb-2">
                                    <div class="card-header"><a class="text-dark collapsed d-block"
                                                                data-toggle="collapse" href="#set_allowances"
                                                                aria-expanded="false">
                                            <strong><?php echo e(trans('file.Allowances')); ?></strong> </a></div>
                                    <div id="set_allowances" class="collapse" data-parent="#accordion">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table  table-bordered dataTable no-footer">
                                                    <tbody>
                                                    <?php
                                                        $allowance_total = 0;
                                                    ?>
                                                    <?php $__currentLoopData = $payslip->allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><strong><?php echo e($allowance['allowance_title']); ?>:</strong>
                                                                <span class="pull-right"><?php echo e($allowance['allowance_amount']); ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $allowance_total += $allowance['allowance_amount']
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><strong><?php echo e(trans('file.Total')); ?>:</strong> <span
                                                                    class="pull-right"><?php echo e($allowance_total); ?></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($payslip->commissions): ?>
                                <div class="card mb-2">
                                    <div class="card-header"><a class="text-dark collapsed d-block"
                                                                data-toggle="collapse" href="#set_commissions"
                                                                aria-expanded="false">
                                            <strong><?php echo e(trans('file.Commissions')); ?></strong> </a></div>
                                    <div id="set_commissions" class="collapse" data-parent="#accordion">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table  table-bordered dataTable no-footer">
                                                    <tbody>
                                                    <?php
                                                        $commission_total = 0;
                                                    ?>
                                                    <?php $__currentLoopData = $payslip->commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><strong><?php echo e($commission['commission_title']); ?>:</strong>
                                                                <span class="pull-right"><?php echo e($commission['commission_amount']); ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $commission_total += $commission['commission_amount']
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><strong><?php echo e(trans('file.Total')); ?>:</strong> <span
                                                                    class="pull-right"><?php echo e($commission_total); ?></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($payslip->loans): ?>
                                <div class="card  mb-2">
                                    <div class="card-header"><a class="text-dark collapsed d-block"
                                                                data-toggle="collapse" href="#set_loan_deductions"
                                                                aria-expanded="false">
                                            <strong><?php echo e(trans('file.Loan')); ?></strong> </a></div>
                                    <div id="set_loan_deductions" class="collapse" data-parent="#accordion">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table  table-bordered dataTable no-footer">
                                                    <tbody>
                                                    <?php
                                                        $loan_total=0;
                                                    ?>
                                                    <?php $__currentLoopData = $payslip->loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><strong><?php echo e(__('Loan Amount')); ?>:</strong> <span
                                                                        class="pull-right"><?php echo e($loan['loan_amount']); ?></span>
                                                            </td>
                                                            <td><strong><?php echo e(__('Monthly Payable')); ?>:</strong> <span
                                                                        class="pull-right"><?php echo e($loan['monthly_payable']); ?></span>
                                                            </td>
                                                            <td><strong><?php echo e(__('Amount Remaining')); ?>:</strong> <span
                                                                        class="pull-right"><?php echo e($loan['amount_remaining']); ?></span>
                                                            </td>
                                                            <td><strong><?php echo e(__('Installment Remaining')); ?>:</strong> <span
                                                                        class="pull-right"><?php echo e($loan['time_remaining']); ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $loan_total += $loan['monthly_payable']
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($payslip->deductions): ?>
                                <div class="card mb-2">
                                    <div class="card-header"><a class="text-dark collapsed d-block"
                                                                data-toggle="collapse" href="#statutory_deductions"
                                                                aria-expanded="false">
                                            <strong><?php echo e(__('Statutory deductions')); ?></strong> </a></div>
                                    <div id="statutory_deductions" class="collapse" data-parent="#accordion">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table  table-bordered dataTable no-footer">
                                                    <tbody>
                                                    <?php
                                                        $deduction_total = 0.00;
                                                    ?>
                                                    <?php $__currentLoopData = $payslip->deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><strong><?php echo e($deduction['deduction_title']); ?>:</strong>
                                                                <span class="pull-right"><?php echo e($deduction['deduction_amount']); ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $deduction_total += $deduction['deduction_amount']
                                                        ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><strong><?php echo e(trans('file.Total')); ?>:</strong> <span
                                                                    class="pull-right"><?php echo e($deduction_total); ?></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($payslip->other_payments): ?>
                                <div class="card mb-2">
                                    <div class="card-header"><a class="text-dark collapsed d-block"
                                                                data-toggle="collapse" href="#set_other_payments"
                                                                aria-expanded="false">
                                            <strong><?php echo e(__('Other Payment')); ?></strong> </a></div>
                                    <div id="set_other_payments" class="collapse" data-parent="#accordion">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table  table-bordered dataTable no-footer">
                                                    <tbody>
                                                    <?php
                                                        $other_payment_total = 0;
                                                    ?>
                                                    <?php $__currentLoopData = $payslip->other_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><strong><?php echo e($other_payment['other_payment_title']); ?>

                                                                    :</strong> <span
                                                                        class="pull-right"><?php echo e($other_payment['other_payment_amount']); ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $other_payment_total += $other_payment['other_payment_amount']
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><strong><?php echo e(trans('file.Total')); ?>:</strong> <span
                                                                    class="pull-right"><?php echo e($other_payment_total); ?></span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <div class="card mb-2">
                                <div class="card-header"><a class="text-dark collapsed d-block"
                                                            data-toggle="collapse" href="#set_annual_leave_info"
                                                            aria-expanded="false">
                                        <strong><?php echo e(__('Annual Leave Info')); ?> (Year - <?php echo e(date('Y')); ?>)</strong> </a></div>
                                <div id="set_annual_leave_info" class="collapse" data-parent="#accordion">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table  table-bordered dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th>Leave Type</th>
                                                        <th>Allocated Day</th>
                                                        <th>Remaining Day</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = $leaveTypeUnserialize; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td> <?php echo e($item['leave_type']); ?> </td>
                                                            <td> <?php echo e($item['allocated_day']); ?> </td>
                                                            <td> <?php echo e($item['remaining_allocated_day']); ?> </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-danger">No Data Found</td>
                                                            <td></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if($payslip->overtimes): ?>
                                <div class="card mb-2">
                                    <div class="card-header"><a class="text-dark collapsed d-block"
                                                                data-toggle="collapse" href="#overtime"
                                                                aria-expanded="false">
                                            <strong><?php echo e(trans('file.Overtime')); ?></strong> </a></div>
                                    <div id="overtime" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><?php echo e(__('Overtime Title')); ?></th>
                                                        <th><?php echo e(__('Number of days')); ?></th>
                                                        <th><?php echo e(trans('file.Hours')); ?></th>
                                                        <th><?php echo e(trans('file.Rate')); ?></th>
                                                        <th><?php echo e(trans('file.Amount')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $overtime_total = 0;
                                                    ?>
                                                    <?php $__currentLoopData = $payslip->overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><strong><?php echo e($loop->iteration); ?></strong></td>
                                                            <td><strong><?php echo e($overtime['overtime_title']); ?></strong></td>
                                                            <td><strong><?php echo e($overtime['no_of_days']); ?></strong></td>
                                                            <td><strong><?php echo e($overtime['overtime_hours']); ?></strong></td>
                                                            <td><strong><?php echo e($overtime['overtime_rate']); ?></strong></td>
                                                            <td><strong><?php echo e($overtime['overtime_amount']); ?></strong></td>
                                                        </tr>
                                                        <?php
                                                            $overtime_total += $overtime['overtime_amount']
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="5" align="right"><strong><?php echo e(trans('file.Total')); ?>

                                                                :</strong></td>
                                                        <td><?php echo e($overtime_total); ?></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header with-border">
                                    <h3 class="card-title"> <?php echo e(trans('file.Details')); ?> </h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table no-footer mt-0">
                                            <tbody>
                                            <tr>
                                                <?php if($payslip->payment_type == 'Hourly'): ?>
                                                    <td><strong><?php echo e(__('Basic Salary')); ?> (<?php echo e(__('Total')); ?>):</strong> <span
                                                                class="pull-right"><?php echo e($amount_hours); ?></span>
                                                    </td>
                                                <?php else: ?>
                                                    <td><strong><?php echo e(__('Basic Salary')); ?>:</strong> <span
                                                                class="pull-right"><?php echo e($payslip->basic_salary); ?></span>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php if(isset($allowance_total)): ?>
                                                <tr>
                                                    <td><strong>Total Allowance:</strong> <span
                                                                class="pull-right"><?php echo e($allowance_total ?? 0.00); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(isset($commission_total )): ?>
                                                <tr>
                                                    <td><strong>Total Commission:</strong> <span
                                                                class="pull-right"><?php echo e($commission_total ?? 0.00); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(isset($payslip->pension_amount )): ?>
                                                <tr>
                                                    <td><strong>Pension Amount:</strong> <span
                                                                class="pull-right"><?php echo e($payslip->pension_amount ?? 0.00); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(isset($loan_total)): ?>
                                                <tr>
                                                    <td><strong>Monthly Payable :</strong> <span
                                                                class="pull-right"><?php echo e($loan_total ?? 0.00); ?></span></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(isset($deduction_total)): ?>
                                                <tr>
                                                    <td><strong>Total Deduction:</strong> <span
                                                                class="pull-right"><?php echo e($deduction_total ?? 0.00); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(isset($other_payment_total)): ?>
                                                <tr>
                                                    <td><strong>Total Other Payment:</strong> <span
                                                                class="pull-right"><?php echo e($other_payment_total ?? 0.00); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(isset($overtime_total)): ?>
                                                <tr>
                                                    <td><strong>Total Overtime:</strong> <span
                                                                class="pull-right"><?php echo e($overtime_total ?? 0.00); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                            <tfooter>
                                                <tr>
                                                    <?php if(config('variable.currency_format') =='suffix'): ?>
                                                        <th class="text-dark"><strong>Paid Amount:</strong> <span
                                                                    class="pull-right"><?php echo e(number_format($payslip->net_salary, 2, '.', '')); ?> <?php echo e(config('variable.currency')); ?></span>
                                                        </th>
                                                    <?php else: ?>
                                                        <th class="text-dark"><strong>Paid Amount:</strong> <span
                                                                    class="pull-right"><?php echo e(config('variable.currency')); ?> <?php echo e(number_format($payslip->net_salary, 2, '.', '')); ?></span>
                                                        </th>
                                                    <?php endif; ?>

                                                </tr>
                                            </tfooter>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\urtasker\resources\views/salary/payslip/show.blade.php ENDPATH**/ ?>