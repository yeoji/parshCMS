<?php

return [

    /**
     * This is the route prefix to access the parsh administration routes
     * Default is /parsh-admin
     */
    'route' => 'parsh-admin',

    /**
     * This is the route middleware to be used to protect access to the parsh routes
     * Substitute with your application's admin/auth middlewares
     */
    'middleware' => ['admin']

];