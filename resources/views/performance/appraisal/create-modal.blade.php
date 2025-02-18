<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.min.js"></script>

<div class="modal fade" id="createModalForm" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="createModalLabel">{{$sectionData[0]['section']['name']}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('submitEmployeeAppraisal')}}" method="post" id="submitForm">
                    @csrf
                    
                    <!-- Company Information -->
                    <div class="form-group">
                    <label for="companyId" class="font-weight-bold" style="font-size: 20px;">Company Name</label>
                    <select name="company_id" id="companyId" class="form-control selectpicker dynamics" 
                                data-live-search="true" data-live-search-style="contains" data-first_name="first_name"
                                data-last_name="last_name" title='{{__('Selecting',['key'=>trans('file.Company')])}}'>
                                @foreach ($companies as $item)
                                    <option value="{{$item->id}}">{{$item->company_name}}</option>
                                @endforeach
                            </select>
                    </div>
                   

                    <!-- Evaluated By & Employee Selection -->
                    <div class="form-group row">
                    <input type="hidden" name="section_name" value="{{$sectionData[0]['section']['name']}}">
                    <input type="hidden" name="section_weightage" value="{{$sectionData[0]['section']['weightage']}}">

                        <div class="col-md-6">
                            <label class="font-weight-bold" style="font-size: 20px;" >Evaluated By</label>
                            <p class="text-muted" style="font-size: 18px;">{{$sectionData[0]['section']['evaluate_by']}}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="employeeId" class="font-weight-bold" style="font-size: 20px;">Select Employee</label>
                            <select name="employee_id" id="employeeId" class="form-control selectpicker" data-live-search="true"></select>
                        </div>
                    </div>

                    <!-- Date Selection -->
                    <div class="form-group">
                        <label for="date" class="font-weight-bold" style="font-size: 20px;">Select Date</label>
                        <input type="text" class="form-control datepicker" style="font-size: 18px;"  name="date" id="date" placeholder="Select Date">
                    </div>

                    <!-- Performance Indicators -->
                    <div class="form-group">
                    <label class="font-weight-bold" style="font-size: 20px;">Performance Indicators</label>
                    @foreach($sectionData[0]['indicators'] as $indicators)
                        <div class="indicator">
                    <label style="font-size: 18px; font-weight: light;">
                        {{$indicators['name']}} <span class="score-display ml-2 font-weight-bold">0/10</span>
                    </label>

                        <div class="rating" data-score="0" data-indicator="{{$indicators['name']}}">
                                @for($i = 1; $i <= 10; $i++)
                                    <i class="fa fa-star" data-value="{{$i}}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="performance_indicators[{{$indicators['name']}}]" value="0">
                        </div>
                        @endforeach
                    </div>

                    <!-- Buttons -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#date').datepicker({ format: 'yyyy-mm-dd', autoclose: true });
        
        $('.rating i').hover(function () {
            $(this).addClass('hover');
            $(this).prevAll().addClass('hover');
        }, function () {
            $('.rating i').removeClass('hover');
        });

        $('.rating i').on('click', function () {
            let value = $(this).data('value');
            let parent = $(this).parent();
            let indicatorName = parent.data('indicator');
            
            parent.attr('data-score', value);
            parent.find('i').removeClass('selected text-warning');
            parent.find('i:lt(' + value + ')').addClass('selected text-warning');
            
            parent.siblings('input[type="hidden"]').val(value);
             // Display selected score (e.g., "3/10") next to the stars
             let scoreDisplay = parent.prev('label').find('.score-display');
scoreDisplay.text(value + "/10");


            if (value === 10) launchConfetti();
        });
    });

    function launchConfetti() {
        confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
        setTimeout(() => {
            confetti({ particleCount: 100, spread: 90, origin: { y: 0.6 } });
        }, 500);
    }
</script>

<style>
    .modal-content {
        background-color: #fff;
        border-radius: 10px;
        padding: 25px;
    }
    .modal-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }
    .form-label {
        font-weight: bold;
    }
    .rating i {
        font-size: 18px;
        color: #ddd;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }
    .rating i.text-warning {
        color: #ffc107;
    }
    .rating i.hover {
        transform: scale(1.2);
    }
    .rating i.selected {
        animation: pop 0.3s ease-in-out;
    }
    @keyframes pop {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
    }

    .score-display {
    font-size: 16px;
    color: #007bff;
}

</style>
