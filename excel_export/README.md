# Excel Export Script

This script (`export.php`) generates an Excel file (`.xlsx`) from a predefined dataset using the `phpoffice/phpspreadsheet` library.

## Prerequisites

1.  **PHP Installation:**
    *   Ensure you have PHP installed on your system. PHP 8.0 or newer is recommended.
    *   Required PHP extensions: `php-xml`, `php-zip`, `php-gd`, and `php-mbstring`. These are commonly included in PHP installations or can be installed separately.

2.  **Composer:**
    *   [Composer](https://getcomposer.org/) must be installed to manage project dependencies.

3.  **Dependencies:**
    *   Navigate to the `excel_export` directory in your terminal.
    *   If you haven't already, install the `phpoffice/phpspreadsheet` library:
        ```bash
        composer require phpoffice/phpspreadsheet
        ```
        This will create a `vendor` directory and a `composer.lock` file.

## File Structure

Ensure your directory structure for the export functionality looks like this:

```
/excel_export
    ├── .gitignore         # Ignores vendor directory and composer.phar
    ├── composer.json      # Defines project dependencies
    ├── composer.lock      # Records exact versions of dependencies
    ├── export.php         # The main script to generate the Excel file
    ├── README.md          # This file
    └── /vendor/           # Directory where Composer installs dependencies
        ├── /phpoffice/
        ├── /composer/
        ├── /psr/
        ├── /maennchen/
        ├── /markbaker/
        └── autoload.php
```

## Running the Script

There are two primary ways to run this script:

### 1. Via a Web Server (Recommended for Downloading)

This is the typical method if you want to download the Excel file through a browser.

*   **Deployment:** Place the entire `excel_export` directory (containing `export.php` and the `vendor/` directory) into your web server's document root (e.g., `htdocs/`, `www/`, `public_html/`).
*   **Configuration:** Ensure your web server (e.g., Apache, Nginx) is configured to execute PHP scripts.
*   **Access:** Open your web browser and navigate to the `export.php` script.
    *   For example, if your web server's root is `http://localhost/` and you placed the `excel_export` directory directly inside it, the URL would be:
        `http://localhost/excel_export/export.php`
*   **Result:** Accessing this URL should automatically trigger the download of an Excel file named `tasks_export.xlsx`.

### 2. Via the Command Line (CLI)

This method is useful for testing or if you want to generate the file directly on the server without web access.

*   **Navigate:** Open your terminal or command prompt and navigate to the `excel_export` directory:
    ```bash
    cd path/to/your/excel_export
    ```
*   **Execute:** Run the script using the PHP CLI:
    ```bash
    php export.php
    ```
*   **Output Redirection (Important for CLI):**
    When run directly via CLI, the script outputs the raw Excel file content (binary data) to the standard output. To save this as a usable `.xlsx` file, you must redirect the output:
    ```bash
    php export.php > tasks_export.xlsx
    ```
    This command will create (or overwrite) the `tasks_export.xlsx` file in your current directory (`excel_export/`).

## Customization

*   **Data Source:** The data is currently hardcoded in the `$data` array within `export.php`. You can modify this array or adapt the script to fetch data from other sources like a database.
*   **Filename:** The default output filename is `tasks_export.xlsx`. This can be changed by modifying the `$filename` variable in `export.php`.
*   **Styling and Formatting:** The script applies basic header styling and column widths. You can extend this using the various features of the `PhpSpreadsheet` library to customize fonts, colors, cell formats, etc. Refer to the [PhpSpreadsheet documentation](https://phpspreadsheet.readthedocs.io/) for more details.
