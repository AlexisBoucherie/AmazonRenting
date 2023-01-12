<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VehicleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vehicle::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Vehicle')
            ->setEntityLabelInPlural('Vehicles')
            ->setSearchFields(['brand', 'model', 'register_plate', 'type', 'localisation'])
            ->setDefaultSort(['brand' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->onlyOnIndex(),
            TextField::new('brand', 'Brand'),
            TextField::new('model', 'Model'),
            IntegerField::new('number_of_doors', 'Number of doors')
                ->hideOnIndex(),
            IntegerField::new('number_of_seats', 'Number of seats')
                ->hideOnIndex(),
            TextField::new('energy', 'Energy')
                ->hideOnIndex(),
            IntegerField::new('volume', 'Volume (L)')
                ->hideOnIndex(),
            TextField::new('transmission', 'Transmission')
                ->hideOnIndex(),
            TextField::new('color', 'Color')
                ->hideOnIndex(),
            TextField::new('licence_required', 'Licence Required')
                ->hideOnIndex(),
            BooleanField::new('is_on_park', 'is_on_park')
                ->hideOnIndex(),
            BooleanField::new('is_available', 'is_available')
                ->hideOnIndex(),
            IntegerField::new('price', 'Price'),
            TextField::new('register_plate', 'Register plate'),
            AssociationField::new('companyId', 'Company'),
            ImageField::new('photo', 'Picture')
                ->setBasePath('/images/upload_vehicle/')
                ->onlyOnIndex(),
            TextField::new('vehicleFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            TextField::new('type', 'Type'),
            TextField::new('localisation', 'Localisation'),
        ];
    }
}
