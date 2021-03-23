<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

        
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('password'),
            TextField::new('username'),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->setChoices(['ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_AUTHOR' => 'ROLE_AUTHOR'])
                ->setRequired(false),
        ];
    }
    
}
