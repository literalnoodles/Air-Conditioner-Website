<?php
$this->get('/admin','AdminController@index');
$this->get('/admin/ajax_process','AdminController@ajax_process');
$this->post('/admin/ajax_process','AdminController@ajax_process');
$this->post('/admin_login','AdminController@login');
$this->post('/admin/update-section','AdminController@update_section');
$this->post('/admin/delete-section','AdminController@delete_section');
$this->post('/admin/update-slides','AdminController@update_slides');

$this->get('/','UserController@index');
$this->get('/get_access','UserController@access');
$this->get('/products','UserController@load_products');
$this->get('/product-details','UserController@load_product_details');
$this->get('/view-cart','UserController@show_cart');
$this->get('/checkout','UserController@checkout');
$this->get('/contact','UserController@load_contact');
$this->get('/about-us','UserController@about_us');

$this->post('/user/register','UserController@register');
$this->post('/user/login','UserController@login');
$this->post('/user/change_password','UserController@change_password');
$this->post('/user/ajax_process','UserController@ajax_process');
$this->post('/update-filter','UserController@update_filter');
$this->post('/update-products','UserController@update_products');
$this->post('/request-order','UserController@request_order');
$this->post('/send-email','UserController@sendmail');
