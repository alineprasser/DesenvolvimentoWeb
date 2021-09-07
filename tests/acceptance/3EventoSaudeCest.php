<?php

class EventoSaudeCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/evento_saude.html');
        $I->selectOption('tipo-evento', '2');
        $I->fillField('nome-evento', 'Covid 19 ');
        $I->fillField('data', '2021-09-21');
        $I->fillField('hora', '15:00');
        $I->fillField('local', 'URS Jacaraipe');
        $I->click('Salvar');
        $I->seeCurrentURLEquals('/evento_saude.html');
    }
}
