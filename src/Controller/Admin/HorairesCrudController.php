<?php
// src/Controller/Admin/HorairesCrudController.php
namespace App\Controller\Admin;

use App\Entity\Horaires;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HorairesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaires::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('jour', 'Jour'),
            TimeField::new('heureOuverture', 'Heure d\'ouverture'),
            TimeField::new('heureFermeture', 'Heure de fermeture'),
        ];
    }
}
