<?php

class CalculoIMCCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/imc.html');
        $I->fillField('peso', '60');
        $I->fillField('altura', '160');
        $I->click('Calcular');
        $I->seeCurrentURLEquals('/imc.html');
    }
}
