<?php

namespace App\Http\API\V1\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends APIController
{
    /**
     * @var string $_for
     */
    protected $_for = "subscriptions";

    /**
     * @var string $_modelClass
     */
    protected $_modelClass = Subscription::class;
}
