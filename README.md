# MediCore Clinic Management System

MediCore Clinic Management System is a comprehensive solution designed to manage the operations of a medical clinic. It includes role-based access control, appointment scheduling, secure medical file management, and more, offering a seamless experience for administrators, doctors, employees, and patients.

---

## Features

### 1. Role-Based Access Control (RBAC)
- **Roles:** Clinic Manager, Doctor, Employee, and Patient.
- Each role has specific permissions and access to different parts of the system.
  - Clinic Manager: Full control over the system.
  - Doctor: Manage appointments and medical files.
  - Employee: Assist with appointment scheduling and administrative tasks.
  - Patient: Book appointments and access their medical records.

### 2. Appointment Management
- Schedule, update, and cancel appointments.
- View upcoming appointments in the dashboard.
- Notifications for appointment confirmations and reminders.

### 3. Medical File Management
- Secure storage for medical files.
- Role-specific access to view or edit medical records.

### 4. Department Management
- Associate doctors and employees with specific departments.
- Display departments and their respective members.

### 5. Dashboard
- Customizable dashboard for each role.
- Real-time updates for critical information such as:
  - Upcoming appointments.
  - Doctor performance ratings.

### 6. Notifications
- Real-time notifications for:
  - New appointments.
  - Changes in appointment status.
  - Send reminder before the appointments

### 7. Ratings
- Display average ratings for doctors.
- Ratings are calculated based on patient feedback.

### 8. Time Slots
- Each doctor set his schedule for incoming week
- Admin and employees can make that for doctors

---

## Tech Stack

### Backend:
- Laravel (PHP framework).

### Frontend:
- Blade Templating Engine.
- Bootstrap (for styling modals, buttons, and layout).

### Database:
- MySQL.

### APIs:
- Authentication via Laravel Sanctum.

### Other Tools:
- Storage for uploaded images and files (via `storage` directory).
- Role management using middleware.
- Roles and permissions using spatie.
- Send code verification using SomarKesen-Telegram-Gateway-laravel-Package.

---

## Installation

### Prerequisites
Ensure you have the following installed on your system:
- PHP >= 8.0
- Composer
- MySQL
- Node.js and npm (for frontend assets)

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/Ali-S-Mohamad/Medical-Clinic-Management-System.git
   cd Medical-Clinic-Management-System
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies:
   ```bash
   npm install && npm run dev
   ```

4. Set up environment variables:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials and other settings.

5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Generate application key:
   ```bash
   php artisan key:generate
   ```

7. Start the server:
   ```bash
   php artisan serve
   ```
   Visit the application at `http://127.0.0.1:8000`.

8. To sending reminder notifications about appointments run scheduling command via:
    ```bash
    php artisan schedule:work
    ```
---

## Directory Structure

### Key Directories:
- **`app/Models`**: Contains models for `Doctor`, `Employee`, `Patient`, `Department`, etc.
- **`app/Http/Controllers`**: Contains controllers such as `AppointmentController`, `DepartmentController`, etc.
- **`resources/views`**: Blade templates for the frontend.
- **`routes/web.php`**: Web routes for the application.

---

## Usage

### Login as admin using this credentials:
- Email : admin@gmail.com 
- Password : 12345678

### Roles and Permissions
- Each role is assigned specific permissions via middleware.

### Appointment Scheduling
- Navigate to the `Appointments` section.
- Fill out the form with patient and doctor details.
- Submit to create a new appointment.

### Viewing Doctors
- Doctors are displayed on the dashboard with their respective departments and ratings.

---

## Development Practices

### 1. Clean Code and SOLID Principles
- **Service Classes:** All business logic is handled in service classes to keep controllers lightweight and focused on request handling.

### 2. Soft Deletes
- Soft deletes are implemented for `Doctors`, `Appointments`, and `Medical Files`.
  - When a doctor or department is deleted, associated appointments are marked as `soft deleted` and can be restored.

### 3. Notification System
- Real-time notifications using Laravel's built-in notification system.

---

## API Documentation

The API endpoints for the Medical Clinic Management System are documented in a Postman Collection. You can use the link below to access it:

[![Postman Collection](https://img.shields.io/badge/Postman-View%20Collection-orange?logo=postman)](https://documenter.getpostman.com/view/24693079/2sAYQanraV)

> Click the button above to view or import the Postman Collection and test the API endpoints directly.


---

## Future Enhancements
- Implement advanced reporting features.
- Add support for multiple clinic branches.
- Enhance the notification system with email and SMS integration.

---

## Credits
This project was built as part of a training program in focal X Agency to enhance skills in:
- Laravel development.
- Role-based access control.
- Secure medical data management.

---

## License
This project is licensed under the MIT License. See the `LICENSE` file for more details.

