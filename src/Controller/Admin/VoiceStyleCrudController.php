<?php

namespace App\Controller\Admin;

use App\Entity\VoiceStyle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VoiceStyleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoiceStyle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('voice_style'),
        ];
    }
}
