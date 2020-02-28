<?php
declare(strict_types=1);

namespace WidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WidgetBundle\Widget\WidgetRepository;

/**
 * Class CreateWidgetAction
 * Package WidgetBundle\Controller
 */
class CreateWidgetAction extends AbstractController
{
    /** @var WidgetRepository */
    private $repository;

    /** @var FormFactoryInterface */
    private $formFactory;

    /**
     * CreateWidgetAction constructor.
     *
     * @param WidgetRepository     $repository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(WidgetRepository $repository, FormFactoryInterface $formFactory)
    {
        $this->repository  = $repository;
        $this->formFactory = $formFactory;
    }

    public function __invoke(string $widgetId, Request $request): Response
    {
        $id = 'some_widget';
        $widget = $this->repository->get($id);
        $model =$widget->getNewInstance();
        $builder = $this->formFactory->createBuilder();
        $widget->configureCreateForm($builder, $widget->getNewInstance());
    }

}
