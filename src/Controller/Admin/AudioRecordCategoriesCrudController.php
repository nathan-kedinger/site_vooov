<?php

namespace App\Controller\Admin;

use App\Entity\AudioRecordCategories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AudioRecordCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AudioRecordCategories::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
