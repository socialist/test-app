<?php

class CategoryCest
{
    public function _before(\FunctionalTester $I) {
        $I->amOnRoute('site/category', ['key' => 'base-1']);
    }

    public function openCategoryPage(\FunctionalTester $I) {
        $I->see('Базовый вектор развития', 'h1');
    }

    public function chooseArticle(\FunctionalTester $I) {
        $I->see('Дурное дело нехитрое: логотип крупнейшей компании по производству мыльных пузырей стал нашим флагом в борьбе с ложью', 'a');
        $I->click('Дурное дело нехитрое: логотип крупнейшей компании по производству мыльных пузырей стал нашим флагом в борьбе с ложью');
        $I->see('Дурное дело нехитрое: логотип крупнейшей компании по производству мыльных пузырей стал нашим флагом в борьбе с ложью', 'h1');
    }
}