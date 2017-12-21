<?php

/*
 * Start composer dependencies
 */

require __DIR__ . '/vendor/autoload.php';

use App\User;
use App\SubscriptionTypeMonth;
use App\SubscriptionTypeSemester;
use App\SubscriptionTypeYearly;
use App\Subscription;
use App\Invoice;

$user = new User('gabriel1nadai1@gmail.com','Gabriel W. Nadai');

$subscriptionType = new SubscriptionTypeMonth();

$subscription = new Subscription($subscriptionType, $user);

$subscription->hire();

$subscription
    ->getSubscriptionType()
    ->sendExpirationAlertEmail($user->getEmail(), $subscription->getCreatedAt());

$subscription->revoke();

/*
echo '<pre>';
var_dump($subscription);
echo '</pre>';
*/
