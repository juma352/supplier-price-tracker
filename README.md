# Supplier Price Tracker

## Overview

Supplier Price Tracker is a web application designed to help businesses track and compare prices from multiple suppliers for various products. It enables users to record price entries from different suppliers over time, view price trends, and make informed purchasing decisions based on price comparisons.

## Features

- Manage suppliers and products.
- Record price entries for products from different suppliers with date and notes.
- View and edit price entries.
- Compare supplier prices for a selected product.
- Dashboard with key statistics and a price comparison chart visualizing the latest prices per supplier per product.

## Installation

### Prerequisites

- PHP >= 7.4
- Composer
- A web server (e.g., Apache, Nginx)
- A database (e.g., MySQL, PostgreSQL)
- Node.js and npm (optional, if using frontend build tools)

### Steps

1. Clone the repository:

   ```bash
   git clone <repository-url>
   cd supplier-price-tracker
   ```

2. Install PHP dependencies via Composer:

   ```bash
   composer install
   ```

3. Copy the example environment file and configure your environment variables:

   ```bash
   cp .env.example .env
   ```

   Update `.env` with your database credentials and other settings.

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Run database migrations:

   ```bash
   php artisan migrate
   ```

6. (Optional) Seed the database with sample data:

   ```bash
   php artisan db:seed
   ```

7. Start the development server:

   ```bash
   php artisan serve
   ```

8. Access the application at `http://localhost:8000`.

## Insights

- The application provides a centralized platform to track supplier prices, helping businesses monitor price fluctuations and supplier competitiveness.
- The price comparison feature allows users to select a product and view prices offered by different suppliers over time.
- The dashboard offers quick insights into the number of products, suppliers, price entries, and recent price trends.
- The price comparison chart on the dashboard visualizes the latest prices from suppliers, aiding quick decision-making.

## Future Enhancements

- Add user authentication and roles for better access control.
- Implement notifications or alerts for significant price changes.
- Add export options for reports.
- Enhance the UI with more interactive charts and filters.

## License

This project is licensed under the MIT License.
