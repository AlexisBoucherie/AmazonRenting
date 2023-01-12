<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Company')
            ->setEntityLabelInPlural('Companies')
            ->setSearchFields(['name', 'email', 'city'])
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnIndex()
            ->hideOnForm(),
            TextField::new('name', 'Name'),
            IntegerField::new('siret', 'Siret'),
            EmailField::new('email', 'Email'),
            TextField::new('password', 'Password')
            ->onlyWhenCreating(),
            TextField::new('address', 'Address')
            ->hideOnIndex(),
            IntegerField::new('zip_code', 'Zip code')
            ->hideOnIndex(),
            TextField::new('city', 'City'),
        ];
    }
}
