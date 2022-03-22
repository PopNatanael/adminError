<?php

declare(strict_types=1);

namespace Frontend\User\Form;

use Frontend\Classs\Entity\Year;
use Frontend\User\FormData\AddYearFormData;
use Frontend\User\InputFilter\YearInputFilter;
use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Hydrator\ObjectPropertyHydrator;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterInterface;

/**
 * Class YearForm
 * @package Frontend\User\Form
 */
class YearForm extends Form
{
    protected InputFilter $inputFilter;

    /**
     * RegisterForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, array $options = [])
    {
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
            'name' => 'Year',
            'type' => 'text',
            'options' => [
                'label' => 'Year'
            ],
            'attributes' => [
                'placeholder' => 'Enter Year...'
            ]
        ], ['priority' => -9]);

        $this->add([
            'name' => 'status',
            'type' => 'select',
            'options' => [
                'label' => 'Year Status',
                'value_options' => [
                    ['value' => Year::STATUS_ACTIVE, 'label' => Year::STATUS_ACTIVE],
                    ['value' => Year::STATUS_DELETED, 'label' => Year::STATUS_DELETED]
                ]
            ],
        ], ['priority' => -30]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Create Year',
                'class' => 'btn btn-primary btn-block'
            ],
            'type' => Submit::class
        ]);
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
