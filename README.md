# Petrol Station Monitor

A comprehensive web application for monitoring and managing petrol station operations in real-time.

## Features

- **Real-time Monitoring**
  - Track fuel levels and sales in real-time
  - Monitor station activities through an intuitive dashboard
  - Get instant updates on fuel levels and transactions

- **Analytics & Reports**
  - Generate detailed reports on sales and inventory
  - Analyze trends and patterns in fuel consumption
  - Make data-driven decisions with comprehensive insights

- **Alert System**
  - Receive instant notifications for low fuel levels
  - Get alerts for critical events and unusual activities
  - Stay informed about important station updates

## Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: SQLite
- **Asset Management**: Vite
- **Authentication**: Laravel's built-in authentication

## Requirements

- PHP >= 8.3
- Composer
- Node.js & NPM
- SQLite

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/oliversimiyu/petrol-station-monitor.git
   cd petrol-station-monitor
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Set up environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Set up the database:
   ```bash
   php artisan migrate
   ```

6. Build assets:
   ```bash
   npm run build
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

1. Register a new account or log in with existing credentials
2. Navigate to the dashboard to view real-time station metrics
3. Use the analytics section to generate reports and insights
4. Monitor alerts for important station updates

## Development

To work on the project locally:

1. Start the Vite development server:
   ```bash
   npm run dev
   ```

2. Run the Laravel development server:
   ```bash
   php artisan serve
   ```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
