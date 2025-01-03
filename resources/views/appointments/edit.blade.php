@extends('layouts.master')
@section('title')
Edit Appointment
@endsection

@section('css')
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Edit Appointment</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('PUT')

                <!-- Patient Selection -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Patient Name</label>
                            <select name="patient_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}"
                                    {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Doctor Selection -->
                       <div class="col-md-6">
                        <div class="form-group">
                            <label>Doctor</label>
                            <select name="doctor_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->employee->id }}"
                                    {{ old('doctor_id', $appointment->doctor_id) == $doctor->employee->id ? 'selected' : '' }}>
                                    {{ $doctor->employee->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Appointment Date -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="appointment_date" class="form-control"
                              value="{{ old('appointment_date', $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') : '') }}">
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="appointment_time">Time</label>
                            <input type="time" id="appointment_time" name="appointment_time" class="form-control"
                            value="{{ old('appointment_time', $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('H:i') : '') }}">
                            </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="scheduled" {{ old('status', $appointment->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ old('status', $appointment->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" cols="30" rows="4" class="form-control">{{ old('notes', $appointment->notes) }}</textarea>
                </div>


                <!-- Submit Button -->
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Update Appointment</button>
                </div>
                <div class="m-t-20 text-center" >
                    <a href="javascript:history.back()" class="btn btn-secondary mb-3" rel="prev"> <i
                        class="fa fa-arrow-left mr-2"></i>Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection

