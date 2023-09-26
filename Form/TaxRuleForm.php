<?php

namespace ColissimoHomeDelivery\Form;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\TaxRule;
use Thelia\Model\TaxRuleI18nQuery;
use Thelia\Model\TaxRuleQuery;

class TaxRuleForm extends BaseForm
{
    protected function buildForm(): void
    {
        $this->formBuilder
            ->add("tax_rule_id",
                ChoiceType::class,
                [
                    'data' => (int)ColissimoHomeDelivery::getConfigValue(ColissimoHomeDelivery::COLISSIMO_TAX_RULE_ID),
                    'choices' => $this->getTaxRules(),
                    'label' => Translator::getInstance()->trans('Tax Rule', [], ColissimoHomeDelivery::DOMAIN_NAME),
                ]
            );
    }

    private function getTaxRules(): array
    {
        $res = [];

        /** @var Request $request */
        $request = $this->request;

        $lang = $request->getSession()?->getAdminEditionLang();

        $taxRules = TaxRuleI18nQuery::create()
            ->filterByLocale($lang->getLocale())
            ->find();

        $res[Translator::getInstance()->trans('Default Tax rule', [], ColissimoHomeDelivery::DOMAIN_NAME)] = null;

        foreach ($taxRules as $taxRule)
        {
            $res[$taxRule->getTitle()] = $taxRule->getId();
        }

        return $res;
    }
}