<?php

namespace App\Controllers;

use App\Models\CommandeModel;

class Home extends BaseController
{
    protected $commandeModel;

    public function __construct()
    {
        //================
        //acces au modele
        //================

        $db      = \Config\Database::connect();

        $this->commandeModel = new CommandeModel();
    }
   
    //=======================================
    // fonction qui affiche la page d'accueil
    //=======================================
    public function index()
    {
        
        echo view('includes/header');
        echo view('pages/home');
        echo view('includes/footer');
      //  return view('login');
    }

    //=========================================================================================================
    // fonction qui affiche la page des commandes Axis reprennant l'ID, le nom de la commande, le prix, la date
    //=========================================================================================================
    public function commande()
    {
        $recherche = $this->request->getVar('q');

        //=======================================
        //Appel de la fonction dans CommandeModel
        //=======================================

        if ($recherche) {
            $builder = $this->commandeModel->getBarreRechercheOrder($recherche); 
        }
        else {
        $builder = $this->commandeModel->getorderCommande()->getResult();
        }

        //============================================================================
        //Création d'un jeu de données $data pouvant être passé à la vue
        //on créé une variable qui récupère le résultat de la requête : getorderaxis()
        //============================================================================

        $data = [
            'id_data' => $builder,
        ];

        //=============================================
        //on charge la vue correspondante
        //et on envoie le jeu de données $data à la vue
        //la vue aura acces a une variable $id_data
        //=============================================

        echo view('includes/header');
        return view('pages/commande', $data);
        echo view('includes/footer');
    }

    //=======================================================================================================================================================
    // fonction qui affiche la page des produits reprennant l'ID, le nom de la marque, le nom du produit, de la commande, le prix d'achat et le prix de vente
    //=======================================================================================================================================================
    public function produit_marque()
    {
        //======================================================
        //création de variable qui prennent la valeur dans l'url
        //======================================================
        $recherche = $this->request->getVar('q');
        $name = $this->request->getVar('name');

        //===============================================================================================================================================================
        // - Si $recherche(q='nom d'un produit ou une partie du nom') est dans l'url alors execute la fonction getBarreRecherche() qui recherche un produit selon son nom
        // - Sinon si $$name(name='nom d'un marque') est dans l'url alors execute la fonction getListeMarque() qui affiche tous les produits d'une marque
        // - Sinon affiche tous les produits 
        //================================================================================================================================================================
        if ($recherche) {
            $builder = $this->commandeModel->getBarreRecherche($recherche);
        } elseif ($name) {
            $builder = $this->commandeModel->getListeMarque($name);
        } else {
            $builder = $this->commandeModel->getproduitM();
        }
        $liste = $this->commandeModel->getMarque();

        $data = [
            'id_data' => $builder,
            'liste' => $liste
        ];

        echo view('includes/header');
        echo view('pages/produit_marque', $data);
        echo view('includes/footer');
    }

    //=====================================================================================================================================
    // fonction qui affiche la page pour modification de prix produit Hikvision selon l'ID reprennant l'ID, le nom de la commande, le prix
    //=====================================================================================================================================
    public function prixHikvision()
    {
        $builder = $this->commandeModel->modifprixhik()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/prixHikvision', $data);
        echo view('includes/footer');
    }

    //=======================================================================================================
    // fonction qui affiche la page des produits en stock reprennant l'ID, le nom de la commande, la quantité
    //=======================================================================================================
    public function produitStock()
    {
        $builder = $this->commandeModel->getStock()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/produitStock', $data);
        echo view('includes/footer');
    }

    //==================================================================================================================
    // fonction qui affiche la page des produits en stock limite > 5 reprennant l'ID, le nom de la commande, la quantité
    //==================================================================================================================
    public function produitLimite()
    {
        $builder = $this->commandeModel->getStockLimit()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/produitLimite', $data);
        echo view('includes/footer');
    }

    //=====================================================================================================================================================================
    // fonction qui affiche la page de modification du Prix d'un produit selon son ID, reprennant l'ID, le nom du produit, le nom de la marque, le prix de vente et d'achat
    //=====================================================================================================================================================================
    public function modif_price()
    {
        $builder = $this->commandeModel->modif_price()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/modif_price', $data);
        echo view('includes/footer');
    }

    //============================================================================================================================================================
    // fonction qui affiche la page de modification du Prix d'une commande selon son ID, reprennant l'ID, le nom du produit, la quantité, la date d'ajout, le prix 
    //============================================================================================================================================================
    public function modif_order($id_order = null)
    {
        $builder = $this->commandeModel->modif_order()->getResult();
        $data = [
            'id_data' => $builder
        ];
        echo view('includes/header');
        echo view('pages/modif_order', $data);
    }

    //=====================================================================================================================================================================
    // fonction qui affiche la page de modification du Prix d'un produit selon son ID, reprennant l'ID, le nom du produit, le nom de la marque, le prix de vente et d'achat
    //=====================================================================================================================================================================
    public function modif_marque($id_product = null)
    {
        $marque = $this->request->getVar('name_marque');
        if ($marque) {
            $builder = $this->commandeModel->modif_marques_full()->getResult();
        } else {
            $builder = $this->commandeModel->modif_marques()->getResult();
        }
        $data = [
            'id_data' => $builder
        ];
        echo view('includes/header');
        echo view('pages/modif_price', $data);
    }

    //=======================================================================================================
    // fonction qui vérifie si la modification de prix d'une commande à été saisie et modifie le prix d'achat 
    //=======================================================================================================
    function edit_validation()
    {
        helper(['forme', 'url']);

        //==============================================
        //oblige à saisir un float non null pour le prix
        //==============================================
        $error = $this->validate([
            'total_price_tax_incl' => 'required|greater_than[0]'
        ]);

        $modif_order = new CommandeModel();

        $id_order = $this->request->getVar('id_order');
        //========================================================================
        // Si la saisie du prix est null affiche un message d'erreur et rafraichie 
        //========================================================================
        if (!$error) {
            $data['id_data'] = $modif_order->modif_order()->getResult();
            $data['error'] = $this->validator;
            echo view('includes/header');
            echo view('pages/modif_order', $data);
        }

        //================================================================================================================================
        // Sinon modfie le prix d'achat et de vente et return à la page des commmandes un envoie un message pour confirmer la modification 
        //================================================================================================================================
        else {
            $data = [
                'total_price_tax_incl' => $this->request->getVar('total_price_tax_incl')
            ];

            $modif_order->updatePrice($id_order, htmlspecialchars($_POST['total_price_tax_incl']));

            $session = \Config\Services::session();

            $session->setFlashdata('success', 'Produit Modifié');

            return $this->response->redirect(site_url('/Home/commande'));
        }
    }

    //======================================================================================================================
    // fonction qui vérifie si la modification de prix d'un produit à été saisie et modifie le prix d'achat puis modifie le 
    // prix de vente selon son coéfficient multiplicateur_value selon sa marque
    //=======================================================================================================================
    function edit_val_marque()
    {
        helper(['forme', 'url']);

        $error = $this->validate([
            'wholesale_price' => 'required|greater_than[0]'
        ]);

        $modif_order = new CommandeModel();

        $marque = $this->request->getVar('name_marque');
        $id_product = $this->request->getVar('id_product');
        $multiplicateur_value = $this->request->getVar('multiplicateur_value');
        if (!$error) {
            $data['id_data'] = $modif_order->modif_marques()->getResult();
            $data['error'] = $this->validator;
            echo view('includes/header');
            echo view('pages/modif_price', $data);
        } else {
            $data = [
                'wholesale_price' => $this->request->getVar('wholesale_price')
            ];

            $modif_order->updatePriceMarque($id_product, htmlspecialchars($_POST['wholesale_price']), $multiplicateur_value);

            $session = \Config\Services::session();

            //==============================================================================
            // - Si le nom de la marque est dans l'url possibilité de modifier tous les prix 
            // - Sinon modifie le prix selon l'ID et retourne à la page produit_marque
            //==============================================================================
            if (isset($marque)) {
                $data['id_data'] = $modif_order->modif_marques_full()->getResult();
                echo view('pages/modif_price', $data);
            } else {

                $session->setFlashdata('success', 'Produit Modifie');

                return $this->response->redirect(site_url('/Home/produit_marque'));
            }
        }
    }
    //$W3campwd56$
    public function login()
    { 
        $session = session();
        $email = htmlspecialchars($this->request->getPost('email'));
        $passwd = htmlspecialchars($this->request->getPost('passwd'));
        $commandeModel = new CommandeModel();
        $data = $commandeModel->login(['email' => $email]); 

         sleep(1);
         if( count($data) > 0 && password_verify($passwd, $data[0]['passwd'])){

            
                $ses_data = [
                    'lastname' => $data[0]['lastname'],
                    'firstname' => $data[0]['firstname'],
                    'email' => $data[0]['email'],
                    'isLoggedIn' => TRUE
                ];
               
                $session->set($ses_data);
                return $this->response->redirect(('/Home'));
            
            

         }
         else{
            $session->setFlashdata('msg', " email ou mot de passe incorrect ");
            echo view('pages/login');
         }
        
    }

    public function deconnexion(){
        $session = session();
        $session->destroy();
        return view('pages/login');

    }

    public function importcsv()
    {

        $commandeModel = new CommandeModel();
        

        if (isset($_POST["import"])) {
    
            $fileName = $_FILES["file"]["tmp_name"];
    
        if ($_FILES["file"]["size"] > 0) {
      
             $file = fopen($fileName, "r");
      
        while (($column = fgetcsv($file, 100000, ";")) !== FALSE) {
      
            $name = $column[0];
            $wholesale_price = $column[1];
            $price = str_replace(',', '.', $wholesale_price);
            $commandeModel = new CommandeModel();
            $data = $commandeModel->import($price,$name); 

            if (isset($data)) {
                $data['id_data'];
            if (! empty($result)) {
                $type = "success";
                $message = "Les Donnees sont importees dans la base de donnees";
            } else {
                $type = "error";
                $message = "Probleme lors de l'importation de donnees CSV";
        }
      }
    }
  }

        /*$input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);

        if (!$input) {
            $data['validation'] = $this->validator;
            return view('/pages/prixhikvision', $data);
        } 
            else 
            {
                if ($file = $this->request->getFile('file')) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('../public/csvfile', $newName);
                        $file = fopen("../public/csvfile/" . $newName, "r");
                        $i = 0;
                        $numberOfFields = 4;

                        $csvArr = array();

                        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                            $num = count($filedata);
                            if ($i > 0 && $num == $numberOfFields) {
                                $csvArr[$i]['id_product'] = $filedata[0]; // Faut modifier 
                                $csvArr[$i]['name'] = $filedata[1];
                                $csvArr[$i]['wholesale_price'] = $filedata[2];
                                $csvArr[$i]['price'] = $filedata[3];
                            }
                            $i++;
                        }
                        fclose($file);

                        $count = 0;
                        foreach ($csvArr as $userdata) {
                            $ps_product = new CommandeModel();

                            $findRecord = $ps_product->where('id_product', $userdata->id)->countAllResults();

                            if ($findRecord == 0) {
                                if ($ps_product->insert($userdata)) {
                                    $count++;
                                }
                            }
                        }
                        session()->setFlashdata('message', $count . ' rows successfully added.');
                        session()->setFlashdata('alert-class', 'alert-success');
                    } else 
                    {
                    session()->setFlashdata('message', 'CSV file coud not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    }
                }
                else 
                {
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }

        //return redirect()->route('/pages/hikvision');*/
    }
}
}