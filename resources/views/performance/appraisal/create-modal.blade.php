<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/ammar.css') }}">


<div class="modal fade" id="createModalForm" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="header-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="modal-title ml-3" id="createModalLabel">{{$sectionData[0]['section']['name']}}</h3>
                    
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('submitEmployeeAppraisal')}}" method="post" id="submitForm">
                    @csrf
                    <input type="hidden" name="section_name" value="{{$sectionData[0]['section']['name']}}">
                    <input type="hidden" name="weightage" value="{{$sectionData[0]['section']['weightage']}}">


                    <div class="section-card">
                        <div class="section-header">
                            <i class="fas fa-building section-icon"></i>
                            <h5>Company Information</h5>
                        </div>
                        <div class="section-content">
                            <div class="form-group">
                                <label for="companyId" class="label-heading">Company Name</label>
                                <select name="company_id" id="companyId" class="form-control selectpicker dynamics" 
                                    data-live-search="true" data-live-search-style="contains" data-first_name="first_name"
                                    data-last_name="last_name" title='{{__('Selecting',['key'=>trans('file.Company')])}}'>
                                    @foreach ($companies as $item)
                                        <option value="{{$item->id}}">{{$item->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <i class="fas fa-users section-icon"></i>
                            <h5>Evaluation Details</h5>
                        </div>
                        <div class="section-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="evaluation-box">
                                        <div class="evaluator-label">Evaluated By</div>
                                        <div class="evaluator-name">
                                            <i class="fas fa-user-tie mr-2"></i>
                                            {{$sectionData[0]['section']['evaluate_by']}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employeeId" class="label-heading">Select Employee</label>
                                        <div class="select-wrapper">
                                            <select name="employee_id" id="employeeId" class="form-control selectpicker" data-live-search="true"></select>
                                            <i class="fas fa-chevron-down select-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <i class="fas fa-calendar-alt section-icon"></i>
                            <h5>Evaluation Period</h5>
                        </div>
                        <div class="section-content">
                            <div class="form-group">
                                <label for="date" class="label-heading">Select Date</label>
                                <div class="input-group date-picker-wrapper">
                                    <input type="text" class="form-control datepicker" name="date" id="date" placeholder="YYYY-MM-DD">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <i class="fas fa-star section-icon"></i>
                            <h5>Performance Indicators</h5>
                        </div>
                        <div class="section-content">
                            @foreach($sectionData[0]['indicators'] as $indicators)
                                <div class="indicator-card">
                                    <div class="indicator-header">
                                        <div class="indicator-name">{{$indicators['name']}}</div>
                                        <div class="score-badge">
                                            <span class="score-display">0</span>
                                            <span class="score-total">/10</span>
                                        </div>
                                    </div>
                                    <div class="rating-container">
                                        <div class="rating" data-score="0" data-indicator="{{$indicators['name']}}">
                                            @for($i = 1; $i <= 10; $i++)

                                                <i class="fa fa-star" data-value="{{$i}}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <input type="hidden" name="performance_indicators[{{$indicators['name']}}]" value="0">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check mr-2"></i>Submit Evaluation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function () {
    // Datepicker Initialization
    $('#date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        templates: {
            leftArrow: '<i class="fas fa-chevron-left"></i>',
            rightArrow: '<i class="fas fa-chevron-right"></i>'
        }
    });

    // Hover Effect for Rating Stars
    $('.rating i').hover(
        function () {
            $(this).addClass('hover');
            $(this).prevAll().addClass('hover');
        },
        function () {
            $('.rating i').removeClass('hover');
        }
    );

    // Click Event for Rating Stars
    $('.rating i').on('click', function () {
        const selectedValue = parseInt($(this).data('value'));
        const ratingContainer = $(this).closest('.rating');
        const indicatorName = ratingContainer.data('indicator');
        const indicatorCard = $(this).closest('.indicator-card');
        
        // Update the rating value and UI
        ratingContainer.attr('data-score', selectedValue);
        
        // Reset all stars first
        ratingContainer.find('i').removeClass('selected text-warning');
        
        // Select stars up to the clicked one
        $(this).addClass('selected text-warning');
        $(this).prevAll().addClass('selected text-warning');

        // Update the hidden input field
        indicatorCard.find(`input[name="performance_indicators[${indicatorName}]"]`).val(selectedValue);

        // Update the score display
        indicatorCard.find('.score-display').text(selectedValue);

        // Debug logging
        console.log(`Indicator: ${indicatorName}, Value: ${selectedValue}`);

        // Launch confetti if score is 10
        if (selectedValue === 10) {
            launchConfetti();
        }
    });

    // Reset rating on double-click
    $('.rating').on('dblclick', function () {
        const indicatorCard = $(this).closest('.indicator-card');
        const indicatorName = $(this).data('indicator');
        
        // Reset UI
        $(this).attr('data-score', 0);
        $(this).find('i').removeClass('selected text-warning');
        
        // Reset hidden input
        indicatorCard.find(`input[name="performance_indicators[${indicatorName}]"]`).val(0);
        
        // Reset score display
        indicatorCard.find('.score-display').text('0');
    });

    // Form submission handler
    $('#submitForm').on('submit', function(e) {
        e.preventDefault();
        
        // Gather all ratings
        const ratings = {};
        $('.rating').each(function() {
            const indicatorName = $(this).data('indicator');
            const score = parseInt($(this).attr('data-score')) || 0;
            ratings[indicatorName] = score;
        });

        // Update all hidden inputs before submission
        Object.entries(ratings).forEach(([indicator, value]) => {
            $(`input[name="performance_indicators[${indicator}]"]`).val(value);
        });

        // Log the final data being submitted
        console.log('Submitting ratings:', ratings);
        
        // Now submit the form
        this.submit();
    });
});

// Confetti Animation Function
function launchConfetti() {
    confetti({ 
        particleCount: 100, 
        spread: 70, 
        origin: { y: 0.6 },
        colors: ['#1e3c72', '#2a5298', '#ffd700']
    });
    setTimeout(() => {
        confetti({ 
            particleCount: 80, 
            spread: 100, 
            origin: { y: 0.6 },
            colors: ['#1e3c72', '#2a5298', '#ffd700']
        });
    }, 500);
    setTimeout(() => {
        confetti({ 
            particleCount: 50, 
            spread: 120, 
            origin: { y: 0.6 },
            colors: ['#1e3c72', '#2a5298', '#ffd700']
        });
    }, 1000);
}

</script>



