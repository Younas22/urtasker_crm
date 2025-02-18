

<div class='h-full w-full>
    <form method="post" action="{{ route('getNewAppraisalType') }}" id="appraisal_section_form" class="form-horizontal">
                @csrf

                <!-- Add Company Selection -->
                <div class="form-group">
                    <label for="company_id">{{__('Company')}}</label>
                    <select name="company_id" id="company_id" class="form-control selectpicker" data-live-search="true" 
                            data-live-search-style="contains" title='{{__('Select',['key'=>trans('file.Company')])}}...'>
                        <option value="add_company" class="font-weight-bold text-success">{{__('Add New Company')}}</option>
                        @php
                        $companies = App\Models\Company::select('id', 'company_name')->get();
                        @endphp
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div id="add-company-section" class="form-group d-none">
                    <label for="new_company_name">{{__('New Company Name')}}</label>
                    <input type="text" name="new_company_name" id="new_company_name" class="form-control"
                           placeholder="{{__('Enter New Company Name')}}">
                </div>

                <!-- Appraisal Section -->
                <div id="sections-container">
                    <div class="section-group mb-4">
                        <div class="form-group">
                            <label for="section_name">{{__('Appraisal Section Name')}}</label>
                            <input type="text" name="section_name[]" class="form-control"
                                   placeholder="{{__('Enter Appraisal Section Name')}}">
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">{{__('Section Weightage (%)')}}</label>
                            <div class="d-flex align-items-center mr-3">
                                <input type="number" name="section_weightage[]" class="form-control section-weightage w-50"
                                    placeholder="0" min="1" max="100" data-prev-value="0">
                                <span class="ml-2">%</span>
                            </div>
                            <div class="dropdown-container">
                                <label for="roles">Evaluate By</label>
                                <select id="roles_0" name="roles[0]" size="4">
                                <option value=6>HR</option>
                                <option value=4>TL</option>
                                <option value=1>Admin</option>
                                <option value=20>Director</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{__('Indicators')}}</label>
                            <div class="indicators-container">
                                <div class="input-group mb-2 indicator-group">
                                    <input type="text" name="indicators[0][]" class="form-control" placeholder="{{__('Enter Indicator')}}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-indicator">{{__('Remove')}}</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary add-indicator">{{__('Add Indicator')}}</button>
                        </div>
                        <button type="button" class="btn btn-danger remove-section">{{__('Remove Section')}}</button>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <p id="weightage-left" class="font-weight-bold text-danger">{{__('Weightage Left:')}} <span>100%</span></p>
                </div>

                <button type="button" id="add-section" class="btn btn-secondary mt-3">{{__('Add Section')}}</button>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success" id="submit-form">{{__('Submit')}}</button>
                </div>
            </form>

            </div>


            
<style>
    .form-group label {
        font-weight: bold;
    }

    .section-group {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .bootstrap-select .dropdown-toggle {
    width: 100% !important;
    text-align: left;
}


    .btn {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .input-group .form-control {
        border-radius: 4px;
    }

    .font-weight-bold {
        font-size: 1.1rem;
    }

    .section-weightage {
        width: 70px !important; /* Ensures a proper width */
        text-align: center; /* Centers the text */
        font-size: 16px; /* Makes it more readable */
    }

    select[multiple] {
        height: auto;
    }
    .dropdown-container {
      max-width: 300px;
      margin: 0 auto;
    }

    label {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 8px;
      display: block;
    }

    select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
    }

    select:focus {
      outline: none;
      border-color: #007BFF;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>


</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sectionsContainer = document.getElementById('sections-container');
    const addSectionButton = document.getElementById('add-section');
    const weightageLeftDisplay = document.getElementById('weightage-left').querySelector('span');
    const submitButton = document.getElementById('submit-form');

    let sectionIndex = 0;
    let weightageLeft = 100;

    // Add a new section
    addSectionButton.addEventListener('click', () => {
        if (weightageLeft <= 0) {
            alert("No weightage left to add a new section!");
            return;
        }

        sectionIndex++;
        const sectionGroup = document.createElement('div');
        sectionGroup.classList.add('section-group', 'mb-4');

        sectionGroup.innerHTML = `
            <div class="form-group">
                <label for="section_name_${sectionIndex}">{{__('Appraisal Section Name')}}</label>
                <input type="text" name="section_name[]" id="section_name_${sectionIndex}" class="form-control"
                       placeholder="{{__('Enter Appraisal Section Name')}}">
            </div>

            <div class="form-group d-flex align-items-center align-items-baseline">
                <label class="mr-3">{{__('Section Weightage (%)')}}</label>
                <div class="d-flex align-items-center mr-3">
                    <input type="number" name="section_weightage[]" class="form-control section-weightage w-50"
                     placeholder="0" min="1" max="100" data-prev-value="0">
                    <span class="ml-2">%</span>
                </div>
                
                <div class="dropdown-container bootstrap-select ">
                    <label for="roles_${sectionIndex}">Evaluate By</label>
                    <select id="roles_${sectionIndex}" name="roles[${sectionIndex}]" size="4" 
        class="form-control selectpicker" data-live-search="false " 
        data-live-search-style="contains" title='{{__('Nothing Selected')}}'>

                        <option value=6>HR</option>
                        <option value=4>TL</option>
                        <option value=1>Admin</option>
                        <option value=20>Director</option>
                    </select>
                </div>
            </div>
            

            <div class="form-group">
                <label>{{__('Indicators')}}</label>
                <div class="indicators-container">
                    <div class="input-group mb-2 indicator-group">
                        <input type="text" name="indicators[${sectionIndex}][]" class="form-control" placeholder="{{__('Enter Indicator')}}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-indicator">{{__('Remove')}}</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary add-indicator">{{__('Add Indicator')}}</button>
            </div>
            <button type="button" class="btn btn-danger remove-section">{{__('Remove Section')}}</button>
        `;

        sectionsContainer.appendChild(sectionGroup);
        attachSectionEventListeners(sectionGroup);
        $('.selectpicker').selectpicker('refresh');
    });

    // Rest of your existing functions...

        function attachSectionEventListeners(section) {
            const weightageInput = section.querySelector('.section-weightage');
            weightageInput.addEventListener('input', handleWeightageChange);

            section.querySelector('.remove-section').addEventListener('click', () => {
                const weightageValue = parseInt(weightageInput.value) || 0;
                weightageLeft += weightageValue;
                updateWeightageDisplay();
                section.remove();
            });

            const addIndicatorButton = section.querySelector('.add-indicator');
            const indicatorsContainer = section.querySelector('.indicators-container');
            addIndicatorButton.addEventListener('click', () => {
                const indicatorGroup = document.createElement('div');
                indicatorGroup.classList.add('input-group', 'mb-2', 'indicator-group');

                indicatorGroup.innerHTML = `
                    <input type="text" name="indicators[${sectionIndex}][]" class="form-control" placeholder="{{__('Enter Indicator')}}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-indicator">{{__('Remove')}}</button>
                    </div>
                `;

                indicatorsContainer.appendChild(indicatorGroup);
                indicatorGroup.querySelector('.remove-indicator').addEventListener('click', () => {
                    indicatorGroup.remove();
                });
            });
        }

        function handleWeightageChange(e) {
    const input = e.target;
    let prevValue = parseInt(input.getAttribute('data-prev-value')) || 0;
    let newValue = parseInt(input.value);

    if (isNaN(newValue) || newValue < 1) {
        alert("Please enter a positive number.");
        newValue = 1;
    } else if (newValue > weightageLeft + prevValue) {
        alert(`Value exceeds available weightage (${weightageLeft + prevValue}%).`);
        newValue = weightageLeft + prevValue;
    }

    // Update weightage calculations
    weightageLeft += prevValue - newValue;
    input.setAttribute('data-prev-value', newValue);

    // **Fix: Set the value properly**
    input.value = newValue;

    updateWeightageDisplay();
}






        function updateWeightageDisplay() {
            weightageLeftDisplay.textContent = `${weightageLeft}%`;
            addSectionButton.disabled = weightageLeft <= 0;
        }

        // Prevent form submission if weightage is not 0
        submitButton.addEventListener('click', (e) => {
            if (weightageLeft !== 0) {
                e.preventDefault();
                alert("Remaining weightage must be 0 to submit the form!");
            }
        });

        // Attach event listeners to the initial section
        document.querySelectorAll('.section-group').forEach(section => {
            attachSectionEventListeners(section);
        });
    });
</script>

<!-- heelo  -->