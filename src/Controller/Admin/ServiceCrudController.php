<?php
namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextareaField::new('description') // Utiliser TextareaField pour la description
                ->setHelp('Utilisez ✔️ pour une tâche accomplie et ✖️ pour une tâche non accomplie. Utilisez des sauts de ligne pour séparer les éléments.'),
            TextField::new('price'),
        ];
    }
}
