<?php
declare(strict_types=1);

namespace App\Widgets\Admin;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Twig\Environment;
use WidgetBundle\Model\SimpleContextFactory;
use WidgetBundle\Model\WidgetContextInterface;
use WidgetBundle\Widget\AbstractWidget;
use WidgetBundle\Widget\WidgetInterface;

/**
 * Class SideMenuWidget
 * Package App\Widgets\Admin
 */
class SideMenuWidget extends AbstractWidget implements WidgetInterface
{
    /** @var Environment */
    private $twig;

    /** @var SimpleContextFactory */
    private $factory;

    /**
     * SideMenuWidget constructor.
     *
     * @param Environment          $twig
     * @param SimpleContextFactory $factory
     */
    public function __construct(Environment $twig, SimpleContextFactory $factory)
    {
        $this->twig    = $twig;
        $this->factory = $factory;
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver
            ->setDefined(['template'])
            ->setRequired('template')
            ->setDefault('template', $this->getTemplate())
            ->setAllowedTypes('template', ['string'])
        ;
    }

    public function execute(WidgetContextInterface $context, array $resolvedData): Response
    {
        $data     = $context->getData();
        $html     = $this->twig->render($resolvedData['template'], $data);
        $response = new Response($html);

        return $response;
    }

    public function getTemplate(): string
    {
        return 'admin/widget/side_menu_widget.html.twig';
    }

    public function getNewInstance(): WidgetContextInterface
    {
        return $this->factory->fromArray($this->id, []);
    }

    public function configureCreateForm(FormBuilderInterface $builder, WidgetContextInterface $context): void
    {
        $builder->add('text', TextType::class, ['required' => true, 'constraints' => [new NotBlank(), new Length(['min' => 5])]]);
    }

}
