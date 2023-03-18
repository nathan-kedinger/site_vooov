<?php

namespace App\Controller\Admin;

use App\Entity\VoiceStyle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoiceStyleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoiceStyle::class;
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
