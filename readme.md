## TODO
- Add unit tests
- Use Doctrine ORM
- Use template engine
- Use DI container

## Important CLI Usage
- PHPStan
    ```
    ./vendor/bin/phpstan
    ```
    or with command bellow if not using phpstan.neon configuration file
    ```
    ./vendor/bin/phpstan analyse ./src/  --level max
    ```
- PHPDoc
    ```
    phpdoc -d ./src/ -t ./docs/
    ```
- PsySH
    ```
    ./vendor/bin/psysh
    ```
- PHPCS
    ```
    phpcs ./src/ --standard=PSR12 -as
    ```
    - ```-a``` for run interactively
    - ```-s``` for show sniff codes in all reports
- PHPCBF
    ```
    phpcbf ./src/ --standard=PSR12
    ```
- PHP
    Run file interactively
    ```
    php -a -d auto_prepend_file=./path/to/file.php
    ```