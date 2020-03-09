# Racoon
Racoon is a fast, lightweight and open-source web development framework for PHP. Developed by James Crisostomo to provide backbone readily available for developing microservices and web applications. Racoon provides essential tools and functionalities in able to create fast and reliable applications. It is written with speed and project maintainability in mind.

### Features
##### 1. Autoloading
Automatically include PHP classes using namespace without the need of include and require function.

##### 2. Routing
Use request URI to define the controller to invoke, operation to do or resources to return in each request.
    
##### 3. Middleware and Afterwares
Middlewares and afterwares are PHP classes used to do simple task like validation, request filtration and event logging. Middlewares are executed before the controller and afterwares are executed after the controller and before the response is displayed.

##### 4. Controller
Controllers are PHP classes which handles and return requested resources. It is recommended that business logic must not be written inside the controllers.

##### 5. UI Templating
Racoon is packaged with it's own UI templating engine called Pangolin UI.

##### 6. Localization
Support multiple translation to your application.

##### 7. Caching
Increase efficiency and decrease request loading time by caching static resources.
