<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Plat;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //3 Catégories

        $catPizza = new Categorie();
        $catPizza->setLibelle('Pizza');
        $catPizza->setImage('pizza_cat.webp');
        $catPizza->setActive(true);

        $catBurger = new Categorie();
        $catBurger->setLibelle('Burger');
        $catBurger->setImage('burger_cat.webp');
        $catBurger->setActive(true);

        $catWraps = new Categorie();
        $catWraps->setLibelle('Wraps');
        $catWraps->setImage('wrap_cat.webp');
        $catWraps->setActive(true);

        $manager->persist($catPizza);
        $manager->persist($catBurger);
        $manager->persist($catWraps);

        //5 Plats

        $district_burger = new Plat();
        $district_burger->setLibelle("District Burger");
        $district_burger->setDescription("Burger composé d'un bun's du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits.");
        $district_burger->setPrix(8.00);
        $district_burger->setImage("hamburger.webp");
        $district_burger->setActive(true);
        $district_burger->setCategorie($catBurger);
        
        $pizza_bianca = new Plat();
        $pizza_bianca->setLibelle("Pizza Bianca");
        $pizza_bianca->setDescription("Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.");
        $pizza_bianca->setPrix(14.00);
        $pizza_bianca->setImage("pizza-salmon.webp");
        $pizza_bianca->setActive(true);
        $pizza_bianca->setCategorie($catPizza);
        
        $buffalo_chicken_wrap = new Plat();
        $buffalo_chicken_wrap->setLibelle("Buffalo Chicken Wrap");
        $buffalo_chicken_wrap->setDescription("Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.");
        $buffalo_chicken_wrap->setPrix(5.00);
        $buffalo_chicken_wrap->setImage("buffalo-chicken.webp");
        $buffalo_chicken_wrap->setActive(true);
        $buffalo_chicken_wrap->setCategorie($catWraps);
        
        $cheeseburger = new Plat();
        $cheeseburger->setLibelle("Cheeseburger");
        $cheeseburger->setDescription("Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.");
        $cheeseburger->setPrix(8.00);
        $cheeseburger->setImage("cheesburger.webp");
        $cheeseburger->setActive(true);
        $cheeseburger->setCategorie($catBurger);
        
        $pizza_hawaienne = new Plat();
        $pizza_hawaienne->setLibelle("Pizza Hawaïenne");
        $pizza_hawaienne->setDescription("La pizza hawaïenne est une délicieuse création culinaire originaire de l'archipel polynésien. Elle est garnie d'une sauce tomate savoureuse, de mozzarella fondante, de jambon cuit et d'ananas frais qui apportent une touche sucrée et acidulée. Cette pizza est un choix populaire pour ceux qui cherchent un peu d'exotisme dans leur repas.");
        $pizza_hawaienne->setPrix(14.00);
        $pizza_hawaienne->setImage("pizza-hawaienne.webp");
        $pizza_hawaienne->setActive(true);
        $pizza_hawaienne->setCategorie($catPizza);
        
        $manager->persist($district_burger);
        $manager->persist($pizza_bianca);
        $manager->persist($buffalo_chicken_wrap);
        $manager->persist($cheeseburger);
        $manager->persist($pizza_hawaienne);

        //2 Utilisateurs

        $user1 = new Utilisateur();
        $user1->setEmail('kelly@gmail.com');
        $user1->setPassword('TEST_USER');
        $user1->setNom('Dillard');
        $user1->setPrenom('Kelly');
        $user1->setTelephone('7896547800');
        $user1->setAdresse('308 Post Avenue');
        $user1->setCp('10001');
        $user1->setVille('New York');
        $user1->setRoles('ROLE_CLIENT');
        
        $user2 = new Utilisateur();
        $user2->setEmail('thom@gmail.com');
        $user2->setPassword('TEST_USER');
        $user2->setNom('Gilchrist');
        $user2->setPrenom('Thomas');
        $user2->setTelephone('7410001450');
        $user2->setAdresse('1277 Sunburst Drive');
        $user2->setCp('90001');
        $user2->setVille('Los Angeles');
        $user2->setRoles('ROLE_CLIENT');

        $manager->persist($user1);
        $manager->persist($user2);
        
        //3 Commandes

        $commande1 = new Commande();
        $commande1->setUtilisateur($user1);
        $commande1->setDateCommande(new \DateTime('2020-11-30 03:52:43'));
        $commande1->setTotal(16.00);
        $commande1->setEtat(3);
        
        $commande2 = new Commande();
        $commande2->setUtilisateur($user1);
        $commande2->setDateCommande(new \DateTime('2020-11-30 04:07:17'));
        $commande2->setTotal(20.00);
        $commande2->setEtat(3);
        
        $commande3 = new Commande();
        $commande3->setUtilisateur($user2);
        $commande3->setDateCommande(new \DateTime('2021-05-04 01:35:34'));
        $commande3->setTotal(10.00);
        $commande3->setEtat(3);     
        
        $manager->persist($commande1);
        $manager->persist($commande2);
        $manager->persist($commande3);

        $manager->flush();
    }
}