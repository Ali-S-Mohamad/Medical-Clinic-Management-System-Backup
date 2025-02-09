<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminderMail;
use App\Notifications\AppointmentReminder;
use Illuminate\Support\Facades\Notification;


class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for upcoming appointments.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $now = Carbon::now();
        $reminderTime = $now->addMinutes(120);

        // Fetch appointments in the next minute
        $appointments = Appointment::whereBetween('appointment_date', [
            $now->format('Y-m-d H:i:00'),
            $reminderTime->format('Y-m-d H:i:59')
        ])->get();

        if ($appointments->isEmpty()) {
            $this->info('No appointments found for reminders.');
            return;
        }

        foreach ($appointments as $appointment) {
            if ($appointment->patient && $appointment->patient->user) {
                $appointment->patient->user->notify(new AppointmentReminder($appointment));
                Notification::send($appointment->patient->user, new AppointmentReminder($appointment));

            } else {
                Log::warning('Missing patient or user for appointment ID: ' . $appointment->id);
            }
        }
        $this->info('Reminders sent successfully!');
    }
}
