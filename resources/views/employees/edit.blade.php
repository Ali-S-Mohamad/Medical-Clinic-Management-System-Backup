@extends('layouts.master')

@section('title')
Edit Employee
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection

@section('content')
@if (session('error'))
        <div class="alert alert-danger fade show" role="alert" style="animation: fadeOut 3s forwards;">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success fade show" role="alert" style="animation: fadeOut 3s forwards;">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Employee</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{ route('users.update', $employee->user) }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label class="display-block">is doctor?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="is_doctor" id="is_doctor" value="1"
                                @if ($employee->user->getRoleNames()->first() == 'doctor') checked @endif>
                            <label class="form-check-label" for="is_doctor">
                                yes
                            </label>
                        </div>
                    </div>
                    </div>

                    {{-- image section --}}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="photo">Profile Image:</label>
                            <div style="display: flex; align-items: center;">
                                @if($employee->user->image)
                                    <!-- IF there is an image -> display it -->
                                    <img id="thumbnail" src="{{ asset('storage/' . $employee->user->image->image_path) }}"
                                        style="width: 70px; height: 70px; margin-left: 10px; cursor: pointer; border-radius: 50%;">
                                @else
                                    <!-- IF there is not an image -> display upload icon -->
                                    <i class="fas fa-upload" id="upload-icon" style="font-size: 30px; cursor: pointer;"></i>
                                @endif
                                    <!-- input field -->
                                <input type="file" id="photo" name="profile_image" accept=".jpg,.jpeg,.png" style="display: none;">

                            </div>
                        </div>
                    </div>

                    {{-- end  of image section --}}
                </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input required name='firstname' value='{{ $employee->user->firstname }}' class="form-control"
                                    type="text">
                            </div>
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input required name='lastname' value='{{ $employee->user->lastname }}' class="form-control"
                                    type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="department-name" class="nb-2">Department</label>
                                <select required name="department_id" id="department-name" class="form-control">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }} </option>
                                    @endforeach
                                </select>
                                <br />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input  required name='email' class="form-control" type="email"
                                    value="{{ $employee->user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="male" {{ old('gender', $employee->user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $employee->user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                                <small class="text-muted">Leave empty to keep the current password.</small>
                            </div>
                            <div class="form-group">
                                <label> Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password">
                                <small class="text-muted">Leave empty to keep the current password.</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input  required name='phone_number' class="form-control" type="text"
                                    value="{{ $employee->user->phone_number }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="nb-2" for="languages">Languages</label>
                                <div class="d-flex flex-wrap">
                                    @foreach($languages as $index => $language)
                                        <div class="col-sm-6 mb-2">
                                            <div class='form-check' id='language'>
                                                <input name='languages_ids[]' value='{{$language->id}}'   {{ $employee->languages->contains($language->id) ? 'checked' : '' }} class='form-check-input' type="checkbox"  id='flexCeckCecked{{$index}}'  >
                                                <label class='form-check-label'  for='flexCeckCecked{{$index}}'> {{$language->name}}  </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>CV:</label>
                                <div class="profile-upload">
                                    @if($employee->cv_path)
                                        @php
                                            $cvFileName = basename($employee->cv_path);
                                            // Remove any numbers followed by an underscore at the beginning of the file to get rid of the time stamp.
                                            $originalFileName = preg_replace('/^\d+_/', '', $cvFileName);
                                        @endphp
                                        <p id="existing-file">
                                          <a href="{{ asset('storage/'.$employee->cv_path) }}" target="_blank">{{ $originalFileName }}</a>
                                        </p>
                                    @endif
                                    <div class="upload-input">
                                          <input type="file" id="new-cv" name="pdf_cv" accept=".pdf" class="form-control" >
                                   </div>
                                </div>
                            </div>
                        </div>

                        <div id="doctor-info">
                            <div class="form-group">
                                <label>Academic Qualifications</label>
                                <textarea class="form-control" id="qualifications" name="qualifications" rows="5" cols="200">{{ $employee->academic_qualifications }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Work Experience</label>
                                <textarea class="form-control" id="Experience" name="experience" rows="5" cols="200">{{ $employee->previous_experience }}</textarea>
                            </div>
                        </div>
                    </div>

                        {{-- upgrade to patient --}}
                            <div class="form-group">
                                <label class="display-block">is patient?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="is_patient_employee" id="is_patient_employee" value="1">
                                    <label class="form-check-label" for="is_patient_employee">
                                        yes
                                    </label>
                                </div>
                            </div>


                        <div class="row">
                            <div class="col-sm-6 patient-field" style="display: none;">
                                <div class="form-group">
                                    <label>Insurance Number</label>
                                    <input name="insurance_number" type="text" value="{{ $employee->user->patient?->insurance_number }}" class="form-control"  placeholder="INS-00000">
                                    <small class="text-muted">Make sure that the number is like the format above.</small>
                                </div>
                            </div>

                            <div class="col-sm-6 patient-field" style="display: none;">
                                <div class="form-group">
                                    <label>Date of birth <span class="text-danger">*</span> </label>
                                    <input   name="dob" type="date" value="{{ $employee->user->patient?->dob }}" class="form-control" >
                                </div>
                            </div>
                        </div>

                        {{-- end of pateint section --}}

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Update Employee</button>
                    </div>
                    <div class="m-t-20 text-center">
                        {{-- <a href="javascript:history.back()" class="btn btn-secondary mb-3" rel="prev">
                            <i class="fa fa-arrow-left mr-2"></i> Back
                        </a> --}}

                        <a href="javascript:void(0)" class="btn btn-secondary" rel="prev" id="backButton">
                            <i class="fa fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script>

        // Hide / display patient fields && // Date of birth validation
        document.addEventListener('DOMContentLoaded', function () {
        const isPatientCheckbox = document.getElementById('is_patient_employee');
        const patientFields = document.querySelectorAll('.patient-field');
        const dobField = document.querySelector('input[name="dob"]');

        function togglePatientFields() {
            const isPatient = isPatientCheckbox.checked;
            patientFields.forEach(field => {
                field.style.display = isPatient ? 'block' : 'none';
            });
            dobField.required = isPatient;
        }

        togglePatientFields();

        isPatientCheckbox.addEventListener('change', togglePatientFields);
    });


            //  Hide old file name section if new file is selected
            document.getElementById('new-cv').addEventListener('change', function() {
                var existingFileMessage = document.getElementById('existing-file');
                if (existingFileMessage) {
                    existingFileMessage.style.display = 'none'; }
                });


                // image & image icon
            document.addEventListener('DOMContentLoaded', function() {
                var uploadIcon = document.getElementById('upload-icon');
                var thumbnail  = document.getElementById('thumbnail');
                var photoInput = document.getElementById('photo');

                // Handle clicking on the image icon
                if (uploadIcon) {
                    uploadIcon.addEventListener('click', function() {
                        photoInput.click();});
                }

                // Handle by clicking on the image
                if (thumbnail) {
                    thumbnail.addEventListener('click', function() {
                        photoInput.click();});
                }

                // Handle image change
                photoInput.addEventListener('change', function(event) {
                    var file = event.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            if (thumbnail) {
                                thumbnail.src = e.target.result;
                            } else {
                                thumbnail = document.createElement('img');
                                thumbnail.id = 'thumbnail';
                                thumbnail.src = e.target.result;
                                thumbnail.style.width = '80px';
                                thumbnail.style.height = '80px';
                                thumbnail.style.marginLeft = '10px';
                                thumbnail.style.cursor = 'pointer';
                                thumbnail.style.borderRadius = '50%';
                                uploadIcon.parentNode.replaceChild(thumbnail, uploadIcon);

                                // add image click event on the new image
                                thumbnail.addEventListener('click', function() {
                                    photoInput.click();
                                });
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });


           //for back boutton
            document.getElementById('backButton').onclick = function() {
                // check if user has role admin
                @if(auth()->user()->hasRole('Admin'))
                    window.location.href = '{{ route("employees.index") }}';
                @else
                    window.location.href = '{{ url("/home") }}';
                @endif
            };


    </script>
@endsection
