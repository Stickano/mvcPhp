# tinyMVC
A tiny Model/View/Controller (mvc) setup for new, small web related projects.

I use this as my initial setup for small web projects. This framework is i.e. used in [phpinit.com](https://phpinit.com) and my [startpage](https://github.com/Stickano/startpage). It is an empty, OOP, mvc pattern which is ready to be quickly expanded upon.

This project takes very much into consideration not to be redundant with code and to have everything broken down in smaller bites, making it more human readable and easier to troubleshoot as you develop along.

If you need a little added functionality, check out [phpinit.com](https://phpinit.com).

1. [**MVC and its Logic**](#mvc-and-its-logic)
1. [**Quick Introduction**](#quick-introduction)

   * [Views and Controllers](#views-and-controllers)
   * [The Crud model](#the-crud-model)
   * [The Singleton](#the-singleton)
   * [Internal Linking](#internal-linking)
   * [Front-end](#front-end)
       * [Error Notifications](#error-notifications)

1. [**Included Documents**](#included-documents)

   * [controllers/index.php](#c-index)
   * [css/styles.css](#styles)
   * [js/extra.js](#js-extra)
   * [js/index.js](#js-index)
   * [media/ico.ico](#ico)
   * [models/connection.php](#connection)
   * [models/crud.php](#crud)
   * [resources/credentials.php](#credentials)
   * [resources/meta.php](#meta)
   * [resources/singleton.php](#singleton)
   * [views/index.php](#v-index)
   * [index.php](#index)
   * [robots.txt](#robots)

### MVC and its Logic
What we want is to separate the view, what the user sees and interacts with, and the logic that manipulate the data for that view on a layer behind.

We use the controllers to load models and set the data values for the view - The layer behind.

Models are there for extended functionality. Models represent a datamodel or a real-life object.

Roughly spoken; Your view holds the content and html elements, the controller gets and sets the data values for the view and it will load the models required to reach that goal.

### Quick Introduction
##### Views and Controllers
The project has a `models/`, `views/` and `controllers/` folder. Individual pages for your site, such as index, about, contact and so forth, should be created as documents in the views folder, along with a controller with the same name in the controllers folder.

For example, if we were to have a blog page on our website, create a file in both views and controllers folder named `blog.php` - Use the index controller as an empty controller example.

The project already holds an empty view and controller for the index. You can see the document in the views folder is plain empty and the document in the controllers folder is just an empty class.

##### The Crud model
The controller accepts a Crud model (create, read, update & delete) for database communication. Get an overview how this crud works on [phpinit.com](https://phpinit.com/#Crud). In order for the crud to work, you first have to define the sever/database credentials in `resources/credentials.php`.

It is not required to use the Crud model, or even having a database connection. They are just there, easy to setup and use if needed - And I usually do need it.

##### The Singleton
A singleton is one of the first objects that is loaded (and in this case, one of the most crucial).

The singleton will look at the URL and load the appropriate view and its associated controller. It will look at the URLs query string (example.com **?blog**) and see if it has a document by the name of `blog.php` in `views/` and `controllers/`.

##### Internal Linking
As noted above, the singleton reads the URL and tries to match any of its queries with documents in the views and controllers folders.

Say you have a `blog.php` document in each the `views/` and `controllers/` folder, the singleton will load those documents if it reads `example.com?blog`, so your internal linking should be `<a href="?blog"> Blog </a>`.

You can have as many queries you like; `<a href="?blog&id=2" ...>`.

##### Front-end
Though this project is created mainly with the back-end in mind, you do get just a few front-end features too.

There is a css document with a few browser resets, there's a way of displaying errors somewhat nicely and if you place javascript files in the js folder and give them the same name as the view and controller document, i.e, `blog.js`, they will be loaded automatically for their corresponding view.

##### Error Notifications
Included is a front-end feature to display errors. It will place itself as a red bar on the top of your site, with the error message, and is close-able.

If the jQuery library is available, then it will close the bar in a sliding manner. If it's not available, then it will close by just removing the container.

To display a notification in the error bar, set a SESSION with the name `error`.
```
$_SESSION['error'] = 'An error occurred';
```

### Included Documents
Further explanation of each individual document in this project and the logic behind.

##### `controllers/index.php` <a name="c-index"></a>
This is controller for the default index page. It is empty and can be used as an example of how a typical controller looks like. Define your views logic in this document. Write the necessary methods and load the relevant models to achieve the functionality of your index page. And follow this logic in further controllers as well.

This controller accepts a Crud model, from `models/crud.php`, as a parameter. You don't necessarily have to use this model for your database communication, but I usually will and let's be brutally honest here, this is probably more for me than it is for you anyways.

##### `css/styles` <a name="styles"></a>
Just a couple of browser resets and the classes for the error container - Which covers the top with a red, close-able alert bar.

##### `js/extra.js` <a name="js-extra"></a>
A javascript document that will always be loaded. You can use this document for js functions that should be available throughout your whole site. By default it holds a function for closing the top-bar error.

##### `js/index.js` <a name="js-index"></a>
An empty javascript document, that will be loaded alongside the `index.php` from the views folder. Create javascript files with the same name as your views to have them loaded exclusively for the individual views.

##### `media/ico.ico` <a name="ico"></a>
My media folder usually holds images, icons and other forms of media. The `ico.ico` is just a blank icon file for the browser tab. This file is loaded as the website icon from the `resources/meta.php` document.

##### `models/connection.php` <a name="connection"></a>
This is actually just an mysqli connection, but I usually use it as a parameter class to other models that requires a explicit connection, such as the crud model.

##### `models/crud.php` <a name="crud"></a>
This is the create, read, update & delete (crud) model I use for database communication. It is a secure and logic way of doing your data interaction with the data in your database. You can see how to use this model at [phpinit.com](https://phpinit.com/#Crud).

##### `resources/credentials.php` <a name="credentials"></a>
This is the place to define your database credentials. It will be read once from the singleton and used to create a connection object (`models/connection.php`).

##### `resources/meta.php` <a name="meta"></a>
This will be read in the headers (`<head>` element). You can define your own projects meta/header information in this document. This document will;

* Load the singleton,
* set the header information
* and load the stylesheet (css/styles.css).

This document also holds 3 CDNs which can easily be un-commented or removed, depending on if the projects need them. The 3 CDNs are for; Font Awesome, VueJs and Jquery.

##### `resources/singleton.php` <a name="singleton"></a>
This crucial document handles the automation of loading the view and its controller.

By default it sets its view and controller to the `index.php` documents found in each representing folder, but if the URLs query string matches one of the document names in the views and controllers folder, then it loads that set instead.

If the credentials file has been defined, this document also initializes a connection and crud object. It will pass the crud object to the controllers as it initializes them, such that you are able to easily communicate with the database in each controller.

If you set a SESSION named `error`, the singleton will threat it as such and its value will be fetched and displayed in a red bar on top of the view.

Lastly the singleton holds a little random method for generating '\&nbsp\;' (spaces). If for example you needed 5 spaces in your view, you could call the singletons `spaces()` method;
```
echo 'A paragraph with 5 spaces, '.$singleton->spaces(5).' because you\'ll never know!';
```

##### `views/index.php` <a name="v-index"></a>
This is the view for the client. This specific document is the default landing page of your website. It is empty and you place your sites cotent (text, html elements etc) in this document and other view documents.

##### `index.php` <a name="index"></a>
This is your typical HTML document (html, head, body).

It;
* reads the headers from the `resources/meta.php` document,
* checks and displays any errors set in the singleton,
* fetches and load the view document,
* loads the `extra.js` documents
* and checks if there's a javascript document associated with the view.

The sites overall design-theme should be defined in this document. Having the content of each page and the design of your site separated, makes it less redundant, easier to edit and troubleshoot.

##### `robots.txt` <a name="robots"></a>
An empty robots.txt document with the most common search engine crawlers.