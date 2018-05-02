<?php

Route::get('/{slug}', 'dmcdenissen\urlalias\UrlaliasController@index')->where('slug', '.*');