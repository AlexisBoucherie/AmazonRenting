<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Event')
            ->setEntityLabelInPlural('Events')
            ->setDefaultSort(['startDate' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnIndex()
                ->hideOnForm(),
            AssociationField::new('userId', 'Customer'),
//            TextField::new('userId', 'Customer')
//                ->onlyOnForms(),
            AssociationField::new('vehicleId', 'Model'),
            DateTimeField::new('start_date', 'Start date'),
            DateTimeField::new('end_date', 'End date'),
            TextField::new('return_localisation', 'Return localisation')
                ->hideOnIndex()
                ->setHelp('* If different to start location'),
            TextField::new('start_condition', 'Start condition')
                ->hideOnIndex(),
            IntegerField::new('licence_number', 'Licence number')
                ->hideOnIndex(),
            IntegerField::new('start_km', 'Start km')
                ->hideOnIndex(),
            IntegerField::new('return_km', 'Return km')
                ->hideOnIndex(),
            TextField::new('status', 'Status')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setCreatedAt(new DateTimeImmutable());

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

}
