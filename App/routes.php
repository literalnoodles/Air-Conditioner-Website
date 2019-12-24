<?php
// $this->get('/','PageController@home');
// $this->get('/contact','PageController@contact');
// $this->get('/about-culture','PageController@about_culture');
// $this->get('/users','UserController@index');
// $this->post('/users','UserController@store');
$this->get('/admin','AdminController@index');
$this->get('/admin/ajax_process','AdminController@ajax_process');
$this->get('/admin/edit-brand','AdminController@edit_brand');
$this->post('/admin_login','AdminController@login');
$this->post('/admin/add-brand','AdminController@add_brand');
$this->post('/admin/edit-brand','AdminController@edit_brand');
$this->post('/admin/delete-brand','AdminController@delete_brand');