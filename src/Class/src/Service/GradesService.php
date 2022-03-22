<?php

declare(strict_types=1);

namespace Frontend\Classs\Service;

use Frontend\Classs\Entity\Classs;
use Frontend\Classs\Entity\Grades;
use Frontend\Classs\Entity\Year;
use Frontend\Classs\Repository\GradesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Dot\AnnotatedServices\Annotation\Inject;
use Dot\AnnotatedServices\Annotation\Service;
use Dot\Mail\Exception\MailException;
use Dot\Mail\Service\MailService;
use Mezzio\Template\TemplateRendererInterface;

/**
 * Class GradesService
 * @package Frontend\Classs\Service
 * @Service()
 */
class GradesService implements GradesServiceInterface
{
    /** @var GradesRepository $repository */
    protected $repository;

    /** @var MailService $mailService */
    protected $mailService;

    /** @var TemplateRendererInterface $templateRenderer */
    protected $templateRenderer;

    /** @var array $config */
    protected $config;

    /**
     * MessageService constructor.
     * @param EntityManager $entityManager
     * @param MailService $mailService
     * @param TemplateRendererInterface $templateRenderer
     * @param array $config
     *
     * @Inject({EntityManager::class, MailService::class, TemplateRendererInterface::class, "config"})
     */
    public function __construct(
        EntityManager $entityManager,
        MailService $mailService,
        TemplateRendererInterface $templateRenderer,
        array $config = []
    ) {
        $this->repository = $entityManager->getRepository(Grades::class);
        $this->mailService = $mailService;
        $this->templateRenderer = $templateRenderer;
        $this->config = $config;
    }

    /**
     * @return GradesRepository
     */
    public function getRepository(): GradesRepository
    {
        return $this->repository;
    }
}
