<?php

namespace App\Controllers;

use App\Models\CommandeModel;

class Home extends BaseController
{
    protected $commandeA;
    protected $commandeH;
    protected $produitS;
    protected $produitL;
    protected $prixHik;
    protected $Marque;
    protected $produitM;
    protected $modif_price;
    protected $modif_order;
    protected $update_order;

    public function __construct()
    {
        $this->commandeA = new CommandeModel();

        $this->commandeH = new CommandeModel();

        $this->produitS = new CommandeModel();

        $this->produitL = new CommandeModel();

        $this->prixHik = new CommandeModel();

        $this->Marque = new CommandeModel();

        $this->produitM = new CommandeModel();

        $this->modif_price = new CommandeModel();

        $this->modif_order = new CommandeModel();

        $this->update_order = new CommandeModel();
    }

    public function index()
    {

        echo view('includes/header');
        echo view('pages/home');
        echo view('includes/footer');
    }

    public function commandeaxis()
    {
        $builder = $this->commandeA->getorderaxis()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('includes/barre_recherche');
        return view('pages/commandeaxis', $data);
        echo view('includes/footer');
    }

    public function commandehikvision()
    {
        $builder = $this->commandeH->getorderhik()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('includes/barre_recherche');
        echo view('pages/commandehikvision', $data);
        echo view('includes/footer');
    }

    public function produit_marque()
    {
        $builder = $this->Marque->getMarque()->getResult();

        $data = [
            'id_data' => $builder
        ];

        $builder2 = $this->produitM->getproduitM()->getResult();

        $donnees = [
            'id_donnees' => $builder2
        ];

        echo view('includes/header');
        echo view('includes/barre_recherche'); //barre recherche autre
        echo view('pages/produit_marque', $donnees);
        echo view('includes/footer');
    }

    public function prixHikvision()
    {
        $builder = $this->prixHik->modifprixhik()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('includes/barre_recherche'); //recherche modif
        echo view('pages/prixHikvision', $data);
        echo view('includes/footer');
    }

    public function produitStock()
    {
        $builder = $this->produitS->getStock()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/produitStock', $data);
        echo view('includes/footer');
    }

    public function produitLimite()
    {
        $builder = $this->produitL->getStockLimit()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/produitLimite', $data);
        echo view('includes/footer');
    }

    public function login()
    {
        echo view('pages/login');
    }

    public function modif_price()
    {
        $builder = $this->modif_price->modif_price()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/modif_price', $data);
        echo view('includes/footer');
    }

    public function modif_order()
    {
        $builder = $this->modif_order->modif_order()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/modif_order', $data);
        echo view('includes/footer');
    }

    public function update_order()
    {
        $builder = $this->update_order->update_order()->getResult();

        $update = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/modif_order', $update);
        echo view('includes/footer');
    }
}
