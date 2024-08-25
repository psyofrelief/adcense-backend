# AdCense Backend

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)

## About AdCense Backend

The powerful AdCense backend was created especially to handle and process ad domain data for the AdCense ad blocking extension. In order for the AdCense extension to use domain data, the backend must retrieve, parse, and store it from EasyList.

## Features

-   **Ad Domain Management**: Automatically fetches and stores ad domains from EasyList.
-   **API Endpoints**: Provides endpoints for the frontend to retrieve and manage ad domain data effectively.
-   **Scheduled Fetching**: Utilizes Laravel's command scheduler to update ad domain lists periodically.

## Technologies Used

-   **Laravel**: A PHP framework that offers a rich set of functionalities for robust backend services.
-   **MySQL**: Used for storing ad domain data in a structured format.

## Installation

To set up the AdCense backend locally, follow these steps:

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/adcense-backend.git
    ```
2. Navigate to the project directory:
    ```bash
    cd adcense-backend
    ```
3. Install PHP dependencies:
    ```bash
    composer install
    ```
4. Copy the `.env.example` file to `.env` and configure your environment (especially database settings):
    ```bash
    cp .env.example .env
    ```
5. Generate an application key:
    ```bash
    php artisan key:generate
    ```
6. Run database migrations:
    ```bash
    php artisan migrate
    ```
7. Seed the database with initial data (if necessary):
    ```bash
    php artisan db:seed
    ```
8. Schedule the command to fetch EasyList:
    ```bash
    php artisan schedule:run
    ```
9. Start the Laravel development server:
    ```bash
    php artisan serve
    ```

## Usage

-   **Fetching Ad Domains**: Every day, the backend is programmed to automatically fetch ad domains. An artisan command can also be used to manually initiate it.
-   **API Access**:Access endpoints so that the extension can manage or retrieve ad domain data as needed.

## Credits

With the goal of improving user experience by lowering ad intrusions, this project was created as a component of the infrastructure that supports the AdCense ad blocking extension.

## License

AdCense's Backend is open-sourced software licensed under the [MIT License](LICENSE).
