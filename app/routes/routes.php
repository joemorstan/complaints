<?php

return $routes = array(

    //PropositionsController
    '/propositions/show/{id}' => 'PropositionsController@show',

    //'/propositions' => 'PropositionsController@index',
    '/propositions/page/{num}' => 'PropositionsController@index',
    '/propositions/page/{num}/{sortBy}' => 'PropositionsController@index',
    '/propositions/page/{num}/{sortBy}/{order}' => 'PropositionsController@index',

    '/propositions/edit/{id}' => 'PropositionsController@edit',
    '/propositions/update' => 'PropositionsController@update',
    '/propositions/delete/{id}' => 'PropositionsController@delete',
    '/propositions/create' => 'PropositionsController@create',
    '/propositions/store' => 'PropositionsController@store',

    //ComplaintsController
    '/complaints/show/{id}' => 'ComplaintsController@show',

    //'/complaints' => 'ComplaintsController@index',
    '/complaints/page/{num}' => 'ComplaintsController@index',
    '/complaints/page/{num}/{sortBy}' => 'ComplaintsController@index',
    '/complaints/page/{num}/{sortBy}/{order}' => 'ComplaintsController@index',

    '/complaints/edit/{id}' => 'ComplaintsController@edit',
    '/complaints/update' => 'ComplaintsController@update',
    '/complaints/delete/{id}' => 'ComplaintsController@delete',
    '/complaints/create' => 'ComplaintsController@create',
    '/complaints/store' => 'ComplaintsController@store',

    //LoginController
    '/login' => 'LoginController@index',
    '/logout' => 'LoginController@logout',
    '/postLogin' => 'LoginController@postLogin',

);