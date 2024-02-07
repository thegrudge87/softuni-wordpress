# SoftUni Games [Course Theme & Plugin]

---

![Theme Version](https://img.shields.io/badge/Theme_Version-1.0.0-blue)&nbsp;&nbsp;&nbsp;
![Plugin Version](https://img.shields.io/badge/Plugin_Version-1.0.0-8A2BE2)&nbsp;&nbsp;&nbsp;
![WordPress Version Required](https://img.shields.io/badge/WordPress-6.0_or_higher-red)&nbsp;&nbsp;&nbsp;
![PHP version required](https://img.shields.io/badge/PHP-7.4_or_higher-red)

[![Static Badge](https://img.shields.io/badge/Demo_Website-Yes-168363)](https://softuni.dmarinovdev.com)

---

## Overview
A project for an online course in SoftUni ["WordPress for Developers – ноември 2023"](https://softuni.bg/trainings/4388/wordpress-for-developers-november-2023). <br>
The project contains a custom-built theme and plugin for WordPress.

### [LIVE DEMO](https://softuni.dmarinovdev.com)

#### [Github Repository](https://github.com/thegrudge87/softuni-wordpress/)

&nbsp;

### Theme
The theme is based on a free template (check the [References](#references) section). 
It covers the basics of a custom theme and, in addition, includes a custom post type template. The theme has a separate options page where the user can configure the banner on the front page. 
The theme supports:
- Website custom logo (if no logo is selected, the website name will be displayed in its place)
- One primary menu
- Post Thumbnails
- 3 Footer widget areas
- "Game CPT" provided from "SoftUni Game" plugin

### Plugin
The plugin adds a custom post type for "Games" with a custom taxonomy as well. The custom taxonomy has a custom field added for thumbnails.

The plugin has its own settings page, where the user can choose for the Game CPT:
- How many posts should be displayed per page 
- How many posts should be listed as related games using the custom field from the `ACF plugin`.   

### References
* Source HTML Template - https://templatemo.com/tm-589-lugx-gaming 
* Live demo of the template - https://templatemo.com/live/templatemo_589_lugx_gaming

## Course Requirements
Your project must have all this functionality to pass the final examination.

### General requirements
* The project must be implemented using the **WordPress platform**

### Theme
The project must have one custom theme, built from scratch, using a free HTML/CSS/JS template of your choice. As a rule of thumb, you should use a GPL-licence template (up to 42 points)

* The theme must be using the native WP_Query() for looping (The_Loop()) different items in the corresponding templates - **6 points** 
* The theme must have at least one file for the header part, including the dynamic `<title>` field, providing the option to enqueue scripts and styles and dynamically populate the HTML attributes - **3 points** 
* The theme must have at least one file for the footer part, providing the option to enqueue scripts and styles - **2 points** 
* The theme must have a page template for the homepage with most of the dynamic of the section (pulling information from blog posts, pages, custom post types, options pages, etc) - **7 points** 
* The theme must have a template for the single view for blog posts - **3 points** 
* The theme must have a template for the single view of one of the Custom Post Types - **3 points** 
* The theme must have at least one custom page template for listing all posts from the custom post type - **3 points** 
* The theme must have all styles and scripts enqueued, using the proper native WP functions - **3 points** 
  * Exception for 3rd party (external) scripts and styles are allowed 
* The theme must have a dedicated archive template for the date archive of blog posts - **3 points** 
* The theme must have a dedicated archive template for the author's archive of blog posts - **3 points** 
* The theme must have registered at least one WordPress menu - **3 points** 
* The theme must have at least one sidebar area registered and display a few widgets there - **3 points**

### Plugin
The project must have at least one custom **WordPress plugin**, built from scratch **(up to 42 points)**

* The plugin must have at least one registered Custom Post Type - **2 points**
* The plugin must have at least one register custom taxonomy, attached to the custom post type from above - **2 points** 
* The plugin must have at least one metabox build using native WP functions (not with ACF or any other plugin). The metabox must have a custom option that works with the post-meta - **5 points** 
* The plugin must have at least one metabox/dashboard field registered with ACF (or a similar plugin) that works with the post-meta - **3 points** 
* The plugin must have an Options Page and have at least one custom option (it might be showing/hiding an element, allowing or disabling a functionality, etc) - **6 points** 
* The plugin must implement an AJAX functionality for a dynamic section of the project. This can be a filter, sorting, or a click event that tracks user activity. - **10 points** 
* The plugin must have functionality separated into different well-described functions, instead of combining everything in a function or two - **6 points** 
* The plugin must register a shortcode, accept attributes and display information from the custom post type - **3 points** 
* The plugin must have at least one filter manipulating a native WordPress element - the title, the content, or anything else of the blog posts or custom post type. Up to the student to decide which one - **5 points**
