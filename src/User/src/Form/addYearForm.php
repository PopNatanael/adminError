<?php

declare(strict_types=1);

namespace Frontend\User\Form;

use Frontend\User\FormData\AddYearFormData;
use Frontend\User\InputFilter\YearInputFilter;
use Laminas\Form\Form;
use Frontend\User\Factory\AddYearDelegator;
use Frontend\Classs\Service\YearService;
use Laminas\Form\Element;
use Laminas\Hydrator\ObjectPropertyHydrator;
use Laminas\Form\Element\Submit;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterInterface;

/**
 * Class AddYearForm
 * @package Frontend\User\Form
 */
class AddYearForm extends Form
{
    protected InputFilter $inputFilter;

    /**
     * RegisterForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, array $options = [])
    {
        exit("yearForm");

        parent::__construct($name, $options);

        $this->init();

        $this->inputFilter = new YearInputFilter();
        $this->inputFilter->init();
    }

    public function init()
    {
        parent::init();

        $this->setObject(new AddYearFormData());
        $this->setHydrator(new ObjectPropertyHydrator());

        $this->add([
            'name' => 'year',
            'type' => 'input',
            'options' => [
                'label' => 'Year'
            ],
            'attributes' => [
                'placeholder' => 'Add Year...'
            ]
        ]);

        $this->add([
            'name' => 'status',
            'type' => 'select',
            'options' => [
                'label' => 'Yearstatus',
                'value_options' => [
                    ['value' => Year::STATUS_ACTIVE, 'label' => Year::STATUS_ACTIVE],
                    ['value' => Year::STATUS_DELETED, 'label' => Year::STATUS_DELETED]
                ]
            ],
        ]);

        // $this->add([
        //     'name' => 'submit',
        //     'attributes' => [
        //         'type' => 'submit',
        //         'value' => 'Add Year',
        //         'class' => 'btn btn-primary btn-block'
        //     ],
        //     'type' => Submit::class
        // ]);
    }

    /**
     * @return InputFilter|InputFilterInterface|null
     */
    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    /**
     * @param InputFilter $inputFilter
     */
    public function setDifferentInputFilter(InputFilter $inputFilter)
    {
        $this->inputFilter = $inputFilter;
        $this->inputFilter->init();
    }
}
