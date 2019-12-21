<?php
// $this->get('/','PageController@home');
// $this->get('/contact','PageController@contact');
// $this->get('/about-culture','PageController@about_culture');
// $this->get('/users','UserController@index');
// $this->post('/users','UserController@store');
$this->get('/admin','AdminController@index');
$this->post('/admin_login','AdminController@login');