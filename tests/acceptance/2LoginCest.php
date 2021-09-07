<?php

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('email', 'alinep@prasser.com');
        $I->fillField('senha', '123');
        $I->click('sign-up');
        $I->seeCurrentURLEquals('/evento_saude.html');
    }
}
