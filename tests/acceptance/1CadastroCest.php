<?php

class CadastroCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/cadastro.html');
        $I->fillField('name', 'Aline Prasser');
        $I->fillField('email', 'alinebp@testeautomatizado.com');
        $I->fillField('nascimento', '2000-05-22');
        $I->fillField('cpf', '12055431714');
        $I->fillField('password', '123');
        $I->fillField('confirm_password', '123');
        $I->click('login');
        $I->seeCurrentURLEquals('/');
    }
}
