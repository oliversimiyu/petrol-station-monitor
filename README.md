# Petrol Station Monitor

A comprehensive web application for monitoring and managing petrol station operations. Built with Laravel, this system helps station managers track fuel levels, sales, and deliveries while providing insightful analytics.

## Features

- **Real-time Dashboard**
  - Monitor current fuel levels
  - Track daily sales
  - View recent deliveries
  - Quick access to key metrics

- **Analytics Dashboard**
  - Daily sales trends (last 7 days)
  - Monthly sales analysis (last 6 months)
  - Stock level analysis with usage percentages
  - Consumption patterns and forecasting
  - Delivery statistics (last 30 days)

- **Fuel Management**
  - Track multiple fuel tanks
  - Record fuel deliveries
  - Monitor stock levels
  - Set low stock alerts

- **Sales Tracking**
  - Record fuel sales
  - Track daily/monthly revenue
  - Generate sales reports

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- SQLite or MySQL

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

3. Install and compile frontend dependencies:
```bash
npm install
npm run dev
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Set up the database:
```bash
php artisan migrate
php artisan db:seed
```

6. Start the development server:
```bash
php artisan serve
```

## Usage

1. Access the application at `http://localhost:8000`
2. Log in with your credentials
3. Navigate to the dashboard to start monitoring your petrol station

## Security

- Authentication required for all operations
- Role-based access control
- Secure data handling
- Input validation and sanitization

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please open an issue in the GitHub repository or contact the development team.
