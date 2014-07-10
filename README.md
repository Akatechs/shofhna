# [shof hna]

"Shofhna" is an open source implementation of the vote based arabic tech community (http://arabia.io)

To see a running version check out <http://www.shofhna.com>

This project is build with the awsome laravel framework [Laravel 4](http://laravel.com/)

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BUUTZDNKCA6NQ)

## Purpose and Features

This project has two main purposes:

- To create the first open source arabic vote based discussion board
- To provide a source of a real website that's using the Laravel PHP Framework and implements good design patterns for its architecture.


The features of [shofhna] are:

- User account management. registering, login, activating and forget password.
- Sorting posts
- Communities for each user submitted post.
- Hierarchical commenting.
- Vote-based posts and comments
- Presenter classes implemented with the [Laravel Auto Presenter](https://github.com/ShawnMcCool/laravel-auto-presenter) package.
- Arabic localized
- Notification system
- ... and others
 

## Requirements

The shofhna website requires a server with PHP 5.4+ that has the MCrypt extension installed.

The database engine that is used to store data for this application could be any of the engines supported by Laravel: MySQL, Postgres, SQLite and SQL Server.

### Project structure

The domain classes can be found in the `app/ArabiaIOClone` directory. This contains all the application's logic. The controllers merely call these classes to perform the application's tasks.

- **Presenters**: Contains all the Presenter classes which utilizes the Laravel Auto Presenter package. This provides a clean way to keep logic out of your views and encapsulate it all into one place.
- **Providers**: Contains all the application's [Service Provider](http://laravel.com/docs/ioc#service-providers) classes, which register the custom components to the application's IoC container. This, among many other advantages, eases the process of injecting classes/implementations.
- **Repositories**: Contains all the Repository classes. Repositories are used to abstract away the persistance layer interactions. This causes your classes to be less tightly coupled to an ORM like Eloquent. All the repositories implement an interface found in the root of the Repositories directory, which makes it easier to switch implementations.
- **Services**
  - **Forms**: Contains the Form classes, which are used to validate the user input upon form submission.
   
## Contributing

Contributions to this repository are more than welcome although not all suggestions will be accepted and merged.

## Authors

**Hichem MHAMED**

## Copyright and license

Code released under [the MIT license](LICENSE).
  
