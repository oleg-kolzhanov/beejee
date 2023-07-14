<?php

namespace App\Routes;

use App\Routes;

/**
 * HTTP request methods enum.
 */
enum Method: string
{
    /**
     * .
     */
    case GET = 'get';

    /**
     * .
     */
    case HEAD = 'head';

    /**
     * .
     */
    case POST = 'post';

    /**
     * .
     */
    case PUT = 'put';

    /**
     * .
     */
    case DELETE = 'delete';

    /**
     * .
     */
    case CONNECT = 'connect';

    /**
     * .
     */
    case OPTIONS = 'options';

    /**
     * .
     */
    case TRACE = 'trace';

    /**
     * .
     */
    case PATCH = 'patch';
}