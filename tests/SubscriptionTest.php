<?php

use App\User;
use App\SubscriptionTypeYearly;
use App\SubscriptionTypeSemester;
use App\SubscriptionTypeMonth;
use App\Subscription;

class SubscriptionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Usuário
     * @var App\User
     */
    protected $user;

    /**
     * Tipo de Assinatura mensal
     * @var App\SubscriptionTypeMonth
     */
    protected $subscriptionTypeMonth;


    /**
     * Tipo de Assinatura semestral
     * @var App\SubscriptionTypeSemester
     */
    protected $subscriptionTypeSemester;

    /**
     * Tipo de Assinatura semestral
     * @var App\SubscriptionTypeYearly
     */
    protected $subscriptionTypeYearly;


    protected function setUp()
    {
        parent::setUp();

        $this->user = new User('gabriel1nadai1@gmail.com','Gabriel W. Nadai');

        $this->subscriptionTypeMonth = new SubscriptionTypeMonth();

        $this->subscriptionTypeSemester = new SubscriptionTypeSemester();

        $this->subscriptionTypeYearly = new SubscriptionTypeYearly();
    }

    public function testCanBeCreatedSubscriptionTypeMonth()
    {
        $subscription = new Subscription($this->subscriptionTypeMonth, $this->user);

        $this->assertInstanceOf(Subscription::class, $subscription);
    }

    public function testSubscriptionTypeMonthWithFiveDaysOfEvaluate()
    {
        $subscription = new Subscription($this->subscriptionTypeMonth, $this->user);

        $expression = $subscription->getSubscriptionType()->getEvaluationPeriod() == \App\SubscriptionType::FIVE_DAYS;

        $this->assertEquals(true, $expression);
    }

    public function testCanBeCreatedSubscriptionTypeSemester()
    {
        $subscription = new Subscription($this->subscriptionTypeSemester, $this->user);

        $this->assertInstanceOf(Subscription::class, $subscription);
    }

    public function testSubscriptionTypeSemesterWithTenDaysOfEvaluate()
    {
        $subscription = new Subscription($this->subscriptionTypeSemester, $this->user);

        $expression = $subscription->getSubscriptionType()->getEvaluationPeriod() == \App\SubscriptionType::TEN_DAYS;

        $this->assertEquals(true, $expression);
    }

    public function testCanBeCreatedSubscriptionTypeYearly()
    {
        $subscription = new Subscription($this->subscriptionTypeYearly, $this->user);

        $this->assertInstanceOf(Subscription::class, $subscription);
    }

    public function testSubscriptionTypeYearlyWithFifteenDaysOfEvaluate()
    {
        $subscription = new Subscription($this->subscriptionTypeYearly, $this->user);

        $expression = $subscription->getSubscriptionType()->getEvaluationPeriod() == \App\SubscriptionType::FIFTEEN_DAYS;

        $this->assertEquals(true, $expression);
    }

    public function testCanBeHireSubscription()
    {
        $subscription = new Subscription($this->subscriptionTypeMonth, $this->user);

        $this->assertEquals(true, $subscription->hire());
    }


    public function testCanBeRevokeSubscription()
    {
        $subscription = new Subscription($this->subscriptionTypeMonth, $this->user);

        $this->assertEquals(true, $subscription->revoke());
    }

    public function testNotSendExpirationAlertEmailMonth()
    {
        $subscription = new Subscription($this->subscriptionTypeMonth, $this->user);

        $isSend = $subscription
            ->getSubscriptionType()
            ->sendExpirationAlertEmail($this->user->getEmail(), $subscription->getCreatedAt());

        $this->assertEquals(false, $isSend);
    }

}
