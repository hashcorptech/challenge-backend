<?php

namespace App;

use Exception;
use DateTime;

/**
 * Tipo da assinatura
 * Class SubscriptionType
 * @package App\Models
 */
abstract class SubscriptionType
{

    /**
     * Mensal
     */
    const TYPE_MONTH = 0;

    /**
     * Semestral
     */
    const TYPE_SEMESTER = 1;

    /**
     * Anual
     */
    const TYPE_YEARLY  = 2;


    /**
     * Constante que representa 5 dias
     */
    const FIVE_DAYS = 5;

    /**
     * Constante que representa 10 dias
     */
    const TEN_DAYS = 10;

    /**
     * Constante que representa 15 dias
     */
    const FIFTEEN_DAYS = 15;


    /**
     * Tipo - Mensal/Semestral/Anual
     * @var
     */
    private $type;

    /**
     * Quantidade em dias do período de avaliação
     * Ex: 5, 10 ou 15 dias.
     * @var
     */
    private $evaluationPeriod;

    /**
     * Valor da da Assinatura - Cada tipo de assinatura tem um preço especifico.
     * @var
     */
    private $value;


    /**
     * Atribui um tipo de período para o tipo de inscrição.
     * @param mixed $type
     */
    protected function setType($type)
    {
        $this->throwExceptionIfTypeIsInvalid($type);

        $this->type = $type;
    }

    /**
     * Método auxiliar para realizar validação se o tipo de período é válida.
     * @param $type
     * @throws Exception
     */
    private function throwExceptionIfTypeIsInvalid($type) {
        $validTypes = [self::TYPE_MONTH, self::TYPE_SEMESTER, self::TYPE_YEARLY];

        if(! in_array($type, $validTypes) ) {
            throw new Exception("Invalid subscription type.");
        }
    }

    /**
     * Atribui um valor para o periodo de avaliação.
     * @param mixed $evaluationPeriod
     */
    protected function setEvaluationPeriod($evaluationPeriod)
    {
        $this->throwExceptionIfEvaluationPeriodIsInvalid($evaluationPeriod);

        $this->evaluationPeriod = $evaluationPeriod;
    }

    /**
     * Método auxiliar para realizar validação se o período de avaliação é válido.
     * @param $type
     * @throws Exception
     */
    private function throwExceptionIfEvaluationPeriodIsInvalid($type) {

        $validEvaluationPeriods = [self::FIVE_DAYS, self::TEN_DAYS, self::FIFTEEN_DAYS];

        if(! in_array($type, $validEvaluationPeriods) ) {
            throw new Exception("Invalid evaluation period.");
        }
    }

    /**
     * Obtém o tipo de assinatura
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Obtém o período de avaliação
     * @return mixed
     */
    public function getEvaluationPeriod()
    {
        return $this->evaluationPeriod;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Notifica algum endereço de e-mail sobre cupom de oferta.
     * @param $to
     * @param $message
     */
    public abstract function sendCouponOfferMail($to);

    /**
     * Notifica algum endereço de e-mail quando a data de expiração está á 15 dias de vencimento.
     * @param $to
     * @return mixed
     */
    public function sendExpirationAlertEmail($to, $expirationDate)
    {
        $dateNow = new Datetime("now");

        $dateInterval = $dateNow->diff($expirationDate);

        if($dateInterval->days == 15) {

            $message = sprintf("Your subscription has 15 days before expiration.");

            $this->sendMail($to, $message);

            return true;
        }

        return false;
    }

    /**
     * Realiza envio de e-mail.
     * @param $to
     * @param $message
     */
    protected function sendMail($to, $message)
    {
        echo sprintf('Sending e-mail to %s with message: %s <br>', $to, $message);
    }
}