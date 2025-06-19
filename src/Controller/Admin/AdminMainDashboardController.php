<?php

namespace App\Controller\Admin;

use App\Entity\Planeta;
use App\Entity\Personaje;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

#[AdminDashboard(routePath: '/admin/main/dashboard', routeName: 'app_admin_dashboard')]
class AdminMainDashboardController extends AbstractDashboardController
{
    public function __construct(private ChartBuilderInterface $chartBuilder) 
    {
    }
    public function index(): Response
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        return $this->render('admin/admin-dashboard.html.twig', [
            'chart' => $chart,
        ]);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('/admin/main/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
    return Dashboard::new()
        ->setDefaultColorScheme('dark');
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Planetas', 'fas fa-globe', Planeta::class);
        yield MenuItem::linkToCrud('Personajes', 'fas fa-globe', Personaje::class);
    }
}
