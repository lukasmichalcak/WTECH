# WTECH 2025 
This project is a collaborative effort between [lukasmichalcak](https://github.com/lukasmichalcak) and [JozefZiduliak](https://github.com/jozefziduliak). We are making an e-shop for electric appliances called Prometex. It runs on html+css+js and laravel.

### Navigation - important directories
- [Figma Designs](./figma)
  - [LoFi design of all pages](./figma/LoFi%20all%20pages)
  - [HiFi previews](./figma/HiFi-preview)
- [Models](./models/README.md) - conceptual and physical models of the database
- [src](./src) - application codebase
  - [app](./src/app) - module for storing the business logic
    - [Helpers](./src/app/Helpers) - helper functions
    - [HTTP/Controllers](./src/app/Http/Controllers) - controller classes
    - [Listeners](./src/app/Listeners) - registered listeners
    - [Models](./src/app/Models) - database models for Eloquent ORM
    - [Providers](./src/app/Providers) - registered providers
  - [database](./src/database) - module for managing database setup
    - [factories](./src/database/factories) - auxiliary factories called by seeder
    - [migrations](./src/database/migrations) - constructor migrations for database tables
    - [seeders](./src/database/seeders) - database seeding
  - [public](./src/public) - public assets
    - [resources/images](./src/public/resources/images) - product images
  - [resources](./src/resources) - application resources
    - [css](./src/resources/css)
    - [icons](./src/resources/icons)
    - [js](/src/resources/js)
  - [routes](./src/routes) - server routes
- [Templates](./templates) - frontend HTML templates for our application

### Project setup
#### Vite
Vite server startup (prerequisite - NodeJS >= v20.18)
```shell
  npm run dev
```

#### Laravel
Some installed PHP runtime is required (e.g. XAMPP). Composer is not necessary, as we don't need to
generate the project anew.

Database migration and seeding
```shell
  php artisan migrate:fresh --seed
```

App startup on development server
```shell
  php artisan serve
```

Build application
```shell
  php run build
```
