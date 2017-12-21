<?php

namespace App;

/**
 * Tipo de Inscrição Semestral
 * Class SubscriptionTypeSemester
 * @package App\Models
 */
class SubscriptionTypeSemester extends SubscriptionType
{

    public function __construct()
    {
        $this->setEvaluationPeriod(self::TEN_DAYS);

        $this->setType(self::TYPE_SEMESTER);

        $this->setValue(1.80*6);
    }

    /**
     * Notifica algum endereço de e-mail sobre cupom de oferta.
     * @param $to
     * @param $message
     */
    public function sendCouponOfferMail($to)
    {
        $message = sprintf("Congratulations! Your receive the discount coupon [ %s ] of 10%% to Yearly subscription.", uniqid());

        $this->sendMail($to, $message);
    }
}