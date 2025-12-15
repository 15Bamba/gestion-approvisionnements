<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use App\Entity\Approvisionnement;
use App\Entity\Article; // Nous n'ajouterons qu'un article simple pour la démo
use App\Entity\LigneApprovisionnement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- 1. Création des Fournisseurs ---
        
        $fournisseurDakar = new Fournisseur();
        $fournisseurDakar->setNom('Textiles Dakar SARL');
        $fournisseurDakar->setContact('77 111 22 33');
        $manager->persist($fournisseurDakar);

        $fournisseurMercerie = new Fournisseur();
        $fournisseurMercerie->setNom('Mercerie Centrale');
        $fournisseurMercerie->setContact('78 444 55 66');
        $manager->persist($fournisseurMercerie);

        $fournisseurTissus = new Fournisseur();
        $fournisseurTissus->setNom('Tissus Premium');
        $fournisseurTissus->setContact('76 777 88 99');
        $manager->persist($fournisseurTissus);


        // --- 2. Création d'un Article de Base (pour les Lignes) ---
        // Bien que les articles ne soient pas détaillés dans la maquette,
        // nous en avons besoin pour satisfaire la relation ManyToOne de LigneApprovisionnement.
        $articleBase = new Article();
        $articleBase->setNom('Tissu de Base');
        $articleBase->setReference('ART-001');
        $articleBase->setPrixUnitaire(10000); 
        $manager->persist($articleBase);


        // --- 3. Création des Approvisionnements (basé sur la maquette) ---
        
        // Approvisionnement 1
        $this->createFullApprovisionnement(
            $manager, 
            'APP-2023-001', 
            '15/04/2023', 
            750000, 
            'Reçu', 
            $fournisseurDakar,
            $articleBase
        );

        // Approvisionnement 2
        $this->createFullApprovisionnement(
            $manager, 
            'APP-2023-002', 
            '10/04/2023', 
            320000, 
            'Reçu', 
            $fournisseurMercerie,
            $articleBase
        );
        
        // Approvisionnement 3
        $this->createFullApprovisionnement(
            $manager, 
            'APP-2023-003', 
            '05/04/2023', 
            450000, 
            'Reçu', 
            $fournisseurTissus,
            $articleBase
        );
        
        // Approvisionnement 4
        $this->createFullApprovisionnement(
            $manager, 
            'APP-2023-004', 
            '01/04/2023', 
            680000, 
            'Reçu', 
            $fournisseurDakar,
            $articleBase
        );
        
        // Approvisionnement 5
        $this->createFullApprovisionnement(
            $manager, 
            'APP-2023-005', 
            '25/03/2023', 
            520000, 
            'Reçu', 
            $fournisseurMercerie,
            $articleBase
        );

        $manager->flush();
    }
    
    // Fonction utilitaire pour créer l'Approvisionnement et la Ligne associée
    // src/DataFixtures/AppFixtures.php

// Fonction utilitaire pour créer l'Approvisionnement et la Ligne associée
    // Fonction utilitaire pour créer l'Approvisionnement et la Ligne associée
    private function createFullApprovisionnement(
        ObjectManager $manager, 
        string $ref, 
        string $dateStr, 
        float $montant, 
        string $statut, 
        Fournisseur $fournisseur,
        Article $article
    ): void
    {
        $appro = new Approvisionnement();
        
        // --- 1. Création et formatage de l'objet date ---
        $dateObj = \DateTimeImmutable::createFromFormat('d/m/Y', $dateStr);
        
        // Vérification de la date
        if ($dateObj === false) {
            throw new \RuntimeException(sprintf('Impossible de parser la date "%s" dans le format "d/m/Y".', $dateStr));
        }

        // --- 2. Paramétrage de l'Approvisionnement ---
        $appro->setReference($ref);
        $appro->setDateCreation($dateObj);
        $appro->setMontantTotal($montant);
        $appro->setStatut($statut);
        $appro->setFournisseur($fournisseur);
        
        $manager->persist($appro); // On persiste l'Approvisionnement
        
        // --- 3. Création de la Ligne d'Approvisionnement (Obligatoire) ---
        $ligne = new LigneApprovisionnement();
        $ligne->setApprovisionnement($appro);
        $ligne->setArticle($article);
        
        // Calcul de la quantité : (Montant total / Prix unitaire) arrondi au supérieur
        $quantite = ceil($montant / $article->getPrixUnitaire());
        
        $ligne->setQuantite((int)$quantite);
        $ligne->setPrixAchat($article->getPrixUnitaire()); 
        
        $manager->persist($ligne); // On persiste la Ligne
    }
// La méthode load() se termine toujours par $manager->flush();
}