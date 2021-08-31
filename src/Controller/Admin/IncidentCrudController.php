<?php

namespace App\Controller\Admin;

use App\Entity\Incident;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class IncidentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Incident::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),

            TextEditorField::new('description'),

            AssociationField::new('user'),
        ];
    }
}
