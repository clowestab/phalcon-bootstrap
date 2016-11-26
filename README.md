##README

This is a bootstrap project for working with the PhalconPHP framework.

It is based on experience, and such a structure is utilised by a number of [Double Negative](http://doublenegative.com) projects.

###Structure

* Controllers go in app/controllers
 * They control page output as directed by the annotations router
* Services go in app/services
 * They manipulate, and process data
 * They perform business logic
* Data Access Objects (DAO) go in app/daos
 * They interact with the database
 * They manipulate the models which they represent
* Models go in app/models
 * They represent data models
 * They map 1-to-1 to database tables.
* Views go in app/views
* View models go in app/viewmodels
 * They define what model data is accessible from within views

 **Configuration**

 All configuration is contained within the app/config directory.

 This includes loading all the required files, and setting up Phalcon services.

**Serving**

* The project entry point is found at public/index.php
* All publicly servable static files are found in the public directory.
 * This includes images, css files, and javascript.
 * Assets which require building should be kept in public/assets, and built to public/build. The assets folder need not be published to your production server.

 ###Notes

 This bootstrap project does not include any build tools. We tend to use [gulp](https://www.npmjs.com/package/gulp).