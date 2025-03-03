# Mailgram

Mailgram is a web-based email management system built with Laravel and Livewire. This project is designed to provide an efficient and interactive experience for handling emails, notifications, and user communication.

## Features
- **Livewire Integration:** Enhances the user experience with real-time updates.
- **Email Management:** Send, receive, and categorize emails within the platform.
- **User Authentication:** Secure login and registration system.
- **Dashboard:** A user-friendly interface to manage emails efficiently.
- **Notifications:** Real-time alerts for new messages and updates.
- **Database Support:** Uses MySQL (or other databases) to store email data.

## Installation

### Prerequisites
- PHP 8.x
- Composer
- Laravel 10.x
- MySQL or PostgreSQL
- Node.js and npm (for frontend assets)

### Setup Instructions
1. **Clone the Repository:**
   ```bash
   git clone https://github.com/yourusername/mailgram.git
   cd mailgram
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Set up database credentials in `.env` file.

4. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

5. **Serve the Application:**
   ```bash
   php artisan serve
   ```
   The application will be available at `http://127.0.0.1:8000`

## Usage
- Register/Login to access the dashboard.
- Manage emails using an intuitive interface.
- Enable real-time notifications and updates.

## Contribution
Feel free to fork this repository and contribute by submitting a pull request. Ensure that your code follows Laravel best practices and is well-documented.

## License
Mailgram is open-source software licensed under the [MIT license](LICENSE).

---
Developed with ❤️ using Laravel & Livewire.

