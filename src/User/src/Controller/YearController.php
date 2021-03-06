<?php

declare(strict_types=1);

namespace Frontend\User\Controller;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Dot\Controller\AbstractActionController;
use Dot\FlashMessenger\FlashMessenger;
use Frontend\App\Plugin\FormsPlugin;
use Frontend\User\Entity\User;
use Frontend\User\Form\UserForm;
use Frontend\User\Form\YearForm;
use Frontend\User\Factory\AddYearDelegator;
use Frontend\User\FormData\UserFormData;
use Frontend\User\InputFilter\EditUserInputFilter;
use Frontend\User\Service\UserService;
use Frontend\Classs\Service\YearService;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class YearController
 * @package Frontend\User\Controller
 */
class YearController extends AbstractActionController
{
    protected RouterInterface $router;

    protected TemplateRendererInterface $template;

    protected UserService $userService;

    protected YearService $yearService;

    protected AuthenticationServiceInterface $authenticationService;

    protected FlashMessenger $messenger;

    protected FormsPlugin $forms;

    protected UserForm $userForm;

    protected YearForm $yearForm;

    /**
     * YearController constructor.
     * @param UserService $userService
     * @param YearService $yearService
     * @param RouterInterface $router
     * @param TemplateRendererInterface $template
     * @param AuthenticationService $authenticationService
     * @param FlashMessenger $messenger
     * @param FormsPlugin $forms
     * @param UserForm $userForm
     * @param YearForm $yearForm
     */
    public function __construct(
        UserService $userService,
        YearService $yearService,
        RouterInterface $router,
        TemplateRendererInterface $template,
        AuthenticationService $authenticationService,
        FlashMessenger $messenger,
        FormsPlugin $forms,
        UserForm $userForm,
        YearForm $yearForm
    ) {
        $this->userService = $userService;
        $this->yearService = $yearService;
        $this->router = $router;
        $this->template = $template;
        $this->authenticationService = $authenticationService;
        $this->messenger = $messenger;
        $this->forms = $forms;
        $this->userForm = $userForm;
        $this->yearForm = $yearForm;
    }

    public function addYearAction(): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'user::addYear',
                [
                    'form' => $this->yearForm
                ]
            )
        );
    }
}
