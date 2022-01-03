<?php
namespace App\Menu;

use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private FactoryInterface $factory;
    private EntityManagerInterface $em;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->em = $entityManager;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menuRepository = $this->em->getRepository(Menu::class);
        $menuEntity = $menuRepository->findOneBy([
            'slug' => 'main'
        ]);

        $menu = $this->factory->createItem('root')
            ->setExtra('translation_domain', 'menu');
        $menu->setChildrenAttributes([
            'class' => 'nav me-auto d-none d-lg-flex'
        ]);

        if($menuEntity) {
            foreach ($menuEntity->getMenuEntries() as $entry) {
                if($entry->getRoute() == 'portfolio_index')
                {
                    $menu->addChild($entry->getTitle(), [
                        'route' => $entry->getRoute(),
                        'extras' => [
                            'routes' => [
                                [
                                    'route' => 'portfolio_show',
                                ],
                            ],
                        ],
                    ])
                        ->setAttributes(['class' => 'nav-item'])
                        ->setLinkAttributes(['class' => 'nav-link link-light px-2']);
                } else{
                    $menu->addChild($entry->getTitle(), ['route' => $entry->getRoute()])
                        ->setAttributes(['class' => 'nav-item'])
                        ->setLinkAttributes(['class' => 'nav-link link-light px-2'])
                        ;
                }
            }
        }
        return $menu;
    }

    public function createSidebarMenu(array $options): ItemInterface
    {
        $menuRepository = $this->em->getRepository(Menu::class);
        $menuEntity = $menuRepository->findOneBy([
            'slug' => 'main'
        ]);

        $menu = $this->factory->createItem('root')
            ->setExtra('translation_domain', 'menu');
        $menu->setChildrenAttributes([
            'class' => 'list-group list-group-flush'
        ]);

        if($menuEntity) {
            foreach ($menuEntity->getMenuEntries() as $entry) {
                if($entry->getRoute() == 'portfolio_index')
                {
                    $menu->addChild($entry->getTitle(), [
                        'route' => $entry->getRoute(),
                        'extras' => [
                            'routes' => [
                                [
                                    'route' => 'portfolio_show',
                                ],
                            ],
                        ],
                    ])
                        ->setAttributes(['class' => 'list-group-item p-0'])
                        ->setLinkAttributes(['class' => 'list-group-item list-group-item-action']);
                } else{
                    $menu->addChild($entry->getTitle(), ['route' => $entry->getRoute()])
                        ->setAttributes(['class' => 'list-group-item p-0'])
                        ->setLinkAttributes(['class' => 'list-group-item list-group-item-action'])
                    ;
                }
            }
        }
        return $menu;
    }

    public function createLoginMenu(array $options): ItemInterface
    {
        $menuRepository = $this->em->getRepository(Menu::class);
        $menuEntity = $menuRepository->findOneBy([
            'slug' => 'login-gate'
        ]);

        $menu = $this->factory->createItem('root')
            ->setExtra('translation_domain', 'menu');
        $menu->setChildrenAttributes([
            'class' => 'nav'
        ]);

        if($menuEntity) {
            foreach ($menuEntity->getMenuEntries() as $entry) {
                $menu->addChild($entry->getTitle(), ['route' => $entry->getRoute()])
                    ->setAttributes(['class' => 'nav-item'])
                    ->setLinkAttributes(['class' => 'nav-link link-light px-2'])
                ;
            }
        }

        return $menu;
    }

}