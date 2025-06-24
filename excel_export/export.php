<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$data = [
    [1, 'Initial project setup and configuration review.', 'Cloned repository, installed dependencies (Composer), configured local environment variables, reviewed Yii application structure, set up database connection in `config/db.php`.', 'May 26, 2025', 8, '', ''],
    [2, 'Develop user authentication module (login, registration, password reset).', 'Developed comprehensive user authentication: Created User model implementing IdentityInterface. Implemented standard login (username/password) via LoginForm. Developed SignupForm for new account creation, including sending email verification links. Engineered a secure forgot password and password reset flow (requestPasswordResetToken, resetPassword actions). Integrated 2-Factor Authentication (2FA) setup during signup (e.g., TOTP authenticator app provisioning). Ensured automatic login after successful email verification by handling the verifyEmail action. Created AuthController and associated views for all authentication actions (login, logout, signup, verify-email, request-password-reset, reset-password, setup-2fa).', 'May 27, 2025', 8, '', ''],
    [3, 'Refine Form Wizard UI/UX for Applicant Profile.', 'Reviewed existing Applicant Profile wizard styling (multi-form.css) and user flow. Improved visual hierarchy and aesthetics of wizard steps. Ensured consistent styling with the overall application theme. Implemented better visual feedback for step transitions and loading states (if any). Enhanced responsiveness for various screen sizes (desktop, tablet, mobile) by adjusting CSS. Added clear visual cues for validation errors and success messages within wizard steps.', 'May 28, 2025', 8, '', ''],
    [4, 'Design database schema for the new \'Appointments\' module.', 'Analyzed requirements for appointment scheduling, created Entity-Relationship Diagram (ERD), designed tables for appointments, availability, services. Wrote Yii migration scripts to create these tables.', 'May 29, 2025', 8, '', ''],
    [5, 'Develop CRUD operations for \'Applicants\' module.', 'Generated `Applicant` model using Gii, created `ApplicantController` with `index`, `view`, `create`, `update`, `delete` actions. Developed corresponding views with forms and data display using Yii widgets.', 'May 30, 2025', 8, '', ''],
    [6, 'Analyze Form Wizard Requirements for Applicant Profile.', 'Reviewed existing applicant profile fields (personal details, education, work experience). Defined logical steps for profile completion wizard (e.g., Step 1: Personal, Step 2: Education, Step 3: Experience). Determined data validation rules for each step.', 'June 2, 2025', 8, '', ''],
    [7, 'Design Integration of jQuery Form Wizard for Applicant Profile.', 'Evaluated `web/wizard/multi-form.js`. Planned Yii2 view structure (`applicant-user/update-wizard.php`) to host the wizard. Designed client-side (JS) and server-side (PHP) validation approach. Decided on submitting all data at the final step.', 'June 3, 2025', 8, '', ''],
    [8, 'Implement Multi-Step Applicant Profile Form (Wizard - Part 1: Structure & Basic JS).', 'Created view file `views/applicant-user/update-wizard.php`. Structured HTML with `<form>` and nested `div.tab` elements for each profile section. Included `multi-form.css` and `multi-form.js`. Initialized the jQuery plugin `$("#profileWizard").multiStepForm();`. Ensured basic Next/Previous button functionality.', 'June 4, 2025', 8, '', ''],
    [9, 'Implement Multi-Step Applicant Profile Form (Wizard - Part 2: Data Handling & Yii Integration).', 'Developed `actionUpdateWizard` in `ApplicantUserController`. Implemented loading of existing applicant data into form fields. Handled POST request, validated data from all steps using Yii models (`AppApplicant`, `AppApplicantEducation`, etc.). Saved validated data across multiple tables upon final submission.', 'June 5, 2025', 8, '', ''],
    [10, 'Document Form Wizard Implementation and Usage for Applicant Profile.', 'Wrote markdown documentation detailing the applicant profile wizard setup. Explained the view structure, JavaScript initialization, and backend data processing flow in `ApplicantController`. Included notes on adding/modifying wizard steps.', 'June 6, 2025', 8, '', ''],
    [11, 'Implement a notification system for application events (e.g., new application, status change).', 'Designed notification logic, created `NotificationService` class. Implemented email notifications using Yii\'s mailer component for events like new user registration and application status updates. Considered future in-app alert implementation.', 'June 9, 2025', 8, '', ''],
    [12, 'Refactor `SiteController` to improve code readability and maintainability.', 'Reviewed existing actions in `SiteController`. Extracted business logic into service classes or models. Simplified complex methods, added inline comments for clarity, and ensured adherence to PSR coding standards.', 'June 10, 2025', 8, '', ''],
    [13, 'Create Custom Bootstrap Theme for Public & Auth Layouts.', 'Researched UI/UX trends and selected a base Bootstrap theme. Customized the theme variables (colors, fonts, spacing) to create a unique brand identity. Applied the custom theme to main application layout (`views/layouts/main.php`) for public-facing pages. Also, created and applied a consistent themed layout (`views/layouts/auth.php`) for authentication pages (login, signup, password reset, etc.), ensuring a cohesive user experience across all parts of the application.', 'June 11, 2025', 8, '', ''],
    [14, 'Integrate a third-party payment gateway for application fees.', 'Researched and selected a payment gateway (e.g., Stripe, PayPal). Installed SDK via Composer. Implemented payment processing logic, handling callbacks/webhooks, and updating payment status in the database.', 'June 12, 2025', 8, '', ''],
    [15, 'Implement Applicant Profile Image Upload (100x100px, PNG/JPG).', 'Developed profile image upload for applicants. Created `ProfileImageUploadForm` model for handling image data. Implemented server-side validation for image dimensions (exactly 100x100 pixels) and file types (PNG, JPG only). Integrated image cropping/resizing library if necessary. Updated `ApplicantController` and relevant views to include image upload field and display current profile picture. Ensured secure storage of uploaded images and linked them to applicant profiles.', 'June 13, 2025', 8, '', ''],
    [16, 'Optimize database queries for the \'ApplicationTracking\' module.', 'Used Yii\'s debug toolbar and database query logging to identify slow queries in `ApplicationTrackingController` and related models. Added database indexes, refactored queries for efficiency (e.g., using eager loading).', 'June 16, 2025', 8, '', ''],
    [17, 'Create an admin dashboard for managing users and applications.', 'Designed dashboard layout. Developed widgets to display key statistics (e.g., total users, pending applications). Implemented tables with searching, sorting, and pagination for user and application management.', 'June 17, 2025', 8, '', ''],
    [18, 'Design Confirmation Modal for Form Wizard Completion.', 'Designed the UI/UX for the confirmation modal displayed after successful submission of the Applicant Profile wizard. Created wireframes/mockups for modal appearance, including placement, size, and styling. Defined the confirmation message content (e.g., "Profile successfully saved!"). Specified modal components like title, body text, and action buttons (e.g., "OK" or "Close"). Outlined trigger conditions (on successful save event from backend).', 'June 18, 2025', 8, '', ''],
    [19, 'Implement Frontend Logic for Form Wizard Confirmation Modal.', 'Wrote JavaScript/jQuery code to manage the Form Wizard Confirmation Modal. Implemented functions to show and hide the Bootstrap modal (or custom modal). Attached event listeners to relevant wizard events or AJAX success callbacks to trigger modal display. Handled user interactions with modal buttons (e.g., closing the modal on "OK" click). Ensured modal content could be dynamically updated if needed (though static content is primary for this confirmation).', 'June 19, 2025', 8, '', ''],
    [20, 'Integrate Confirmation Modal with Applicant Profile Wizard Backend.', 'Modified the `ApplicantUserController` (or relevant controller action handling the Applicant Profile wizard submission) to facilitate the display of the confirmation modal. Upon successful server-side validation and data saving for all wizard steps, ensured the backend sends a specific signal/response (e.g., a JSON flag, a specific HTTP status, or a Yii flash message) that the frontend JavaScript can detect to trigger the \'show modal\' logic. Tested the end-to-end flow from wizard submission to modal display.', 'June 20, 2025', 8, '', ''],
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set Headers
$headers = ['S/No.', 'Task', 'Activities', 'Date', 'HRS', 'Supervisor', 'Supervisor Remarks'];
$sheet->fromArray($headers, NULL, 'A1');

// Populate Data
$sheet->fromArray($data, NULL, 'A2');

// Apply styling to header
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['argb' => 'FFFFFFFF'],
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FF4F81BD'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];
$sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
$sheet->getRowDimension(1)->setRowHeight(20);


// Set Column Widths
$sheet->getColumnDimension('A')->setWidth(8);   // S/No.
$sheet->getColumnDimension('B')->setWidth(60);  // Task
$sheet->getColumnDimension('C')->setWidth(100); // Activities
$sheet->getColumnDimension('D')->setWidth(15);  // Date
$sheet->getColumnDimension('E')->setWidth(8);   // HRS
$sheet->getColumnDimension('F')->setWidth(20);  // Supervisor
$sheet->getColumnDimension('G')->setWidth(30);  // Supervisor Remarks

// Wrap text for Activities column
$sheet->getStyle('C2:C' . (count($data) + 1))->getAlignment()->setWrapText(true);
// Also wrap text for Task column as some tasks can be long
$sheet->getStyle('B2:B' . (count($data) + 1))->getAlignment()->setWrapText(true);


// Set headers for download
$filename = 'tasks_export.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit;
?>
