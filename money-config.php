<?php

use Chetkov\Money\Exchanger\ExchangerInterface;
use Chetkov\Money\Exchanger\RatesProvider\SimpleExchangeRatesProvider;
use Chetkov\Money\Exchanger\SimpleExchanger;

$exchangeRates = [
    'USD-RUB' => [66.34, 68.21],
    'EUR-RUB' => [72.42, 74.61],
    'JPY-RUB' => [0.61],
];

return [
    'is_currency_conversation_enabled' => true,
    'exchanger_factory' => static function () use ($exchangeRates): ExchangerInterface {
        static $instance;
        if (null === $instance) {
            $ratesProvider = SimpleExchangeRatesProvider::getInstance($exchangeRates);
            $instance = new SimpleExchanger($ratesProvider);
        }
        return $instance;
    },
];