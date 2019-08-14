<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecordController extends AbstractController
{
    /**
     * @Route("/record/{id}", name="record")
     */
    public function index(int $id = 1)
    {
        $library = [
            [
                'id' => 1,
                'titre' => 'L\'école du Micro d\'argent',
                'auteur' => 'IAM',
                'parution' => new \DateTime('1990-11-11'),
                'presentation' => 'Un classique du rap français'],

            ['id' => 2,
                'titre' => 'Thriller',
                'auteur' => 'Michael Jackson',
                'parution' => new \DateTime('1989-01-08'),
                'presentation' => 'La légende de la POP'],
            ['id' => 3,
                'titre' => 'Diamonds are back',
                'auteur' => 'Rihanna',
                'parution' => new \DateTime('2019-08-01'),
                'presentation' => 'Une nouveauté de Rihanna'],
            ['id' => 4,
                'titre' => 'Diamonds',
                'auteur' => 'Rihanna',
                'parution' => new \DateTime('1965-11-11'),
                'presentation' => 'Le classique de rihanna']];

        $i = 0;
        while($id != $library[$i]['id'])
        {
            $i++;
        }

        $record = $library[$i];

        $auteur = $record['auteur'];

        $selection = array_filter($library, function($item) use ($auteur) {
            return $item['auteur'] == $auteur;
        });

        return $this->render('record/index.html.twig', [
            'controller_name' => 'RecordController',
            'library' => $library,
            'record' => $record,
            'selection' => $selection
        ]);
    }

/*    public function sameAuthor($auteur)
    {
        $selection = array_filter($library, function($item) use ($auteur) {
            return $item['auteur'] == $auteur;
        });

        return $this->render(
            'record/sameauthor.html.twig',
            ['selection' => $selection]
        );
    }*/
}
