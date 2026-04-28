# Pandemic Resilience System (PRS)

## Project Overview
The Pandemic Resilience System (PRS) is a working prototype designed to provide a secure solution for pandemic-associated modalities. It manages vaccination data, document uploads, and audit logs while providing a platform to conduct secure user operations. The system is built on a modular backend architecture using real RESTful APIs and emphasizes security through API key authentication and comprehensive audit logging.

## Technologies Used
* **Backend:** PHP (REST API Development)
* **Database:** MySQL (Relational Database)
* **Environment:** XAMPP (Local Server)
* **Frontend:** HTML, CSS, JavaScript (Vanilla JS using Fetch API)
* **Testing:** Postman

## Security Features
* **API Key Authentication:** Applied to sensitive endpoints to ensure secure access.
* **Audit Logging:** Comprehensive tracking of all key user actions (e.g., login, view, upload).
* **Structured Requests:** Strict adherence to POST/GET methods depending on the required access level.

## Database Design & ER Model
The project utilizes a relational database schema (hosted on XAMPP) consisting of six primary tables, all linked with foreign key constraints to maintain data integrity:
`users`, `roles`, `vaccination_records`, `documents`, `audit_logs`, and `secure_keys`.

**Entity Relationships:**

| Relationship | Type | Description |
| :--- | :---: | :--- |
| **Roles → Users** | 1 → Many | One role is assigned to many users. |
| **Users → Vaccination_Records** | 1 → Many | One user can have multiple vaccination records. |
| **Users → Documents** | 1 → Many | One user can upload multiple documents. |
| **Users → Audit_Logs** | 1 → Many | The system tracks multiple actions for each user. |
| **Users → Encryption_Keys** | 1 → Many | Each user can have one or more encryption keys. |

## RESTful API Endpoints
The PHP-based backend exposes the following endpoints to handle system functionality:
* `auth.php` – Login functionality with auditing.
* `user_api.php` – Retrieve user data.
* `vaccinations.php` – Add new vaccination records.
* `get_vaccinations.php` – Publicly fetch vaccination data.
* `get_vaccinations_protected.php` – API key-protected access to vaccination data.
* `upload_document.php` – Upload documents to the server.
* `get_documents.php` – Retrieve uploaded documents.
* `log_action.php` – Insert audit log entries.
* `get_logs.php` – Retrieve user action logs.
* `store_key.php` / `get_key.php` – Save and retrieve API keys securely.

## Frontend Interfaces
The frontend interfaces are built with vanilla HTML, JavaScript, and CSS, connecting to the backend via the Fetch API:
* **Document Upload UI:** Inputs for document name, file upload, and API key authentication.
* **Document View UI:** Fetches and lists all uploaded files by user ID and API key.
* **Audit Logs UI:** Retrieves and displays user actions (login, view, etc.).
* **Vaccination Records UI:** A protected interface utilizing user ID and API key for secure access.

## Future & Proposed Features
While the core modules are fully developed, the following features are proposed for future iterations (UI mockups for these are included in the project files):
* **User Activity Reports:** Action counts tracked per day/month.
* **Document Upload Stats:** Statistical breakdowns (e.g., counts by region or type).
* **Admin Dashboard:** A full panel with analytics, user filtering, and system statistics.
* **Enhanced Registration:** Advanced input validation and a comprehensive user registration module.
