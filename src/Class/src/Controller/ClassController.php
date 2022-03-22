<?php

namespace Frontend\Classs\Controller;

use Dot\AnnotatedServices\Annotation\Inject;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Dot\Controller\AbstractActionController;
use Dot\FlashMessenger\FlashMessenger;
use Dot\Mail\Exception\MailException;
use Fig\Http\Message\RequestMethodInterface;
use Frontend\Classs\Form\ClassForm;
use Frontend\Classs\Service\ClassService;
use Frontend\Classs\Entity\Classs;
use Frontend\Classs\Entity\Grades;
use Frontend\Classs\Entity\Year;
use Frontend\Classs\Service\GradesService;
use Frontend\Classs\Service\YearService;
use Frontend\Plugin\FormsPlugin;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;

class ClassController extends AbstractActionController
{
    /** @var RouterInterface $router */
    protected RouterInterface $router;

    /** @var TemplateRendererInterface $template */
    protected TemplateRendererInterface $template;

     /** @var ClassService $classService */
     protected ClassService $classService;

    /** @var AuthenticationServiceInterface $authenticationService */
    protected AuthenticationServiceInterface $authenticationService;

    /** @var FlashMessenger $messenger */
    protected FlashMessenger $messenger;

    /** @var FormsPlugin $forms */
    protected FormsPlugin $forms;

    /**
     * UserController constructor.
     * @param ClassService $classService
     * @param RouterInterface $router
     * @param TemplateRendererInterface $template
     * @param AuthenticationService $authenticationService
     * @param FlashMessenger $messenger
     * @param FormsPlugin $forms
     * @Inject({
     *     ClassService::class,
     *     RouterInterface::class,
     *     TemplateRendererInterface::class,
     *     AuthenticationService::class,
     *     FlashMessenger::class,
     *     })
     */
    public function __construct(
        ClassService $classService,
        RouterInterface $router,
        TemplateRendererInterface $template,
        AuthenticationService $authenticationService,
        FlashMessenger $messenger
    ) {
        $this->classService = $classService;
        $this->router = $router;
        $this->template = $template;
        $this->authenticationService = $authenticationService;
        $this->messenger = $messenger;
    }

    public function yearAction(): ResponseInterface
    {
        $year = new Year("active", "2");
        $this->classService->getRepository()->saveYear($year);

        $params = $this->getRequest()->getQueryParams();
        $search = (!empty($params['search'])) ? $params['search'] : null;
        $sort = (!empty($params['sort'])) ? $params['sort'] : "created";
        $order = (!empty($params['order'])) ? $params['order'] : "desc";
        $offset = (!empty($params['offset'])) ? (int)$params['offset'] : 0;
        $limit = (!empty($params['limit'])) ? (int)$params['limit'] : 30;
        $result = $this->classService->getClasses($offset, $limit, $search, $sort, $order);

        return new JsonResponse($result);
    }
}
