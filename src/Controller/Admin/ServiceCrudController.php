<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [


            TextField::new('nom'),
            TextEditorField::new('description'),
            ImageField::new('illust')->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash] . [extension]')
                ->setRequired(false),
            SlugField::new('slug')->setTargetFieldName('nom'),
            BooleanField::new('isNew'),
            BooleanField::new('isPromo'),
            AssociationField::new('category')
        ];
    }
}
