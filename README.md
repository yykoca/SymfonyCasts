# SymfonyCasts

### Install Symfony Project
    composer create-project symfony/website-skeleton [PROJECT_NAME]

### To Start Symfony Server
    symfony serve -d

    // Web server listening on
    http://127.0.0.1:8000

### Install Api Platform
    composer require api

    // Api platform running on
    http://127.0.0.1:8000/api


###  DATABASE URL in .env file

Let's open up our .env file and tweak the DATABASE_URL. My computer uses root with no password... and how about cheese_whiz for the database name.

    DATABASE_URL="mysql://[USER]:[PASSWORD]@127.0.0.1:3306/[DATABASE_NAME]"
    DATABASE_URL="mysql://root:@127.0.0.1:3306/cheese_whiz"

You can also create a .env.local file and override DATABASE_URL there. Using root and no password is pretty standard, so I like to add this to .env and commit it as the default.


#### If it is necessary

    composer require maker --dev

### To create a Entity

    php bin/console make:entity


### Create Database

    php bin/console doctrine:database:create

### Migration
    
    php bin/console make:migration

    php bin/console doctrine:migrations:migrate

#### DEBUG ROUTER
    
    php bin/console debug:router

#### Using the Profiler in an API

    composer require profiler --dev


#### Install Carbon
A simple PHP API extension for DateTime.
    
    composer require nesbot/carbon


#### Controlling Field Names:
    
    #[SerializedName('description')]
    public function setTextDescription(string $description): self
    {}

