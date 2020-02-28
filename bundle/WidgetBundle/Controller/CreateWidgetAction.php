<?php
declare(strict_types=1);

namespace WidgetBundle\Controller;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use WidgetBundle\Widget\WidgetRepository;

/**
 * Class CreateWidgetAction
 * Package WidgetBundle\Controller
 */
class CreateWidgetAction
{
    /** @var WidgetRepository */
    private $repository;

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var Environment */
    private $twig;

    /**
     * CreateWidgetAction constructor.
     *
     * @param WidgetRepository     $repository
     * @param FormFactoryInterface $formFactory
     * @param Environment          $twig
     */
    public function __construct(WidgetRepository $repository, FormFactoryInterface $formFactory, \Twig\Environment $twig)
    {
        $this->repository  = $repository;
        $this->formFactory = $formFactory;
        $this->twig        = $twig;
    }

    public function __invoke(string $widgetId, Request $request): Response
    {
        $widget  = $this->repository->get($widgetId);
        $model   = $widget->getNewInstance();
        $builder = $this->formFactory->createBuilder();
        $widget->configureCreateForm($builder, $widget->getNewInstance());
        $form    = $builder->getForm();
        $content = $this->twig->render(
            '@Widget/widget/base_form.html.twig',
            ['form' => $form->createView(), 'widget' => $widget, 'id' => $widgetId]
        );

        return new Response($content);
    }

    public function post(string $widgetId, Request $request): Response
    {
        $widget  = $this->repository->get($widgetId);
        $model   = $widget->getNewInstance();
        $builder = $this->formFactory->createBuilder();
        $widget->configureCreateForm($builder, $widget->getNewInstance());
        $form = $builder->getForm();
        $form->handleRequest($request);
        if (false === $form->isSubmitted()) {
            $form->submit($request->request->all());
        }
        if (false === $form->isValid()) {
            $content = $this->twig->render(
                '@Widget/widget/base_form.html.twig',
                ['form' => $form->createView(), 'widget' => $widget, 'id' => $widgetId]
            );

            return new Response($content, Response::HTTP_BAD_REQUEST);
        }

        return new Response();
    }
}
