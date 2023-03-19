<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('firstname'),
            TextField::new('pseudo'),
            TextField::new('email'),
            TextField::new('birthday'),
            TextField::new('phone'),
            NumberField::new('number_of_moons'),
            NumberField::new('number_of_friends'),
            NumberField::new('number_of_followers'),
            TextField::new('last_connection'),
            TextField::new('sign_in'),
            TextField::new('url_profile_picture'),
            TextEditorField::new('description'),
        ];
    }
}
