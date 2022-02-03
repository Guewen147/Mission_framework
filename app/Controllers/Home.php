<?php

namespace App\Controllers;

use App\Models\CommandeModel;

class Home extends BaseController
{
    protected $commandeModel;

    public function __construct()
    {
        $this->commandeModel = new CommandeModel();
    }

    public function index()
    {

        echo view('includes/header');
        echo view('pages/home');
        echo view('includes/footer');
    }

    public function commandeaxis()
    {
        $builder = $this->commandeModel->getorderaxis()->getResult();

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
        $builder = $this->commandeModel->getorderhik()->getResult();

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
        $builder = $this->commandeModel->getMarque()->getResult();

        $data = [
            'id_data' => $builder
        ];

        $builder2 = $this->commandeModel->getproduitM()->getResult();

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
        $builder = $this->commandeModel->modifprixhik()->getResult();

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
        $builder = $this->commandeModel->getStock()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/produitStock', $data);
        echo view('includes/footer');
    }

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

    public function modif_order()
    {
        $builder = $this->commandeModel->modif_order()->getResult();

        $data = [
            'id_data' => $builder
        ];

        echo view('includes/header');
        echo view('pages/modif_order', $data);
        echo view('includes/footer');
    }

    public function update_order()
    {
        $update = $this->commandeModel->update_order();

        echo view('pages/modif_order', [


            'update' => $update,

        ]);
    }

    public function login()
    {
        $session = session();

        $email = $this->request->getVar('email');
        $passwd = $this->request->getVar('passwd');
        //$password = hash('SHA256',$password);
        $data = $this->commandeModel->login($email)->getResult(); 
         
         if(!empty($email)){
            echo 'yaya';
            $pass = $_GET['passwd'];
            $authenticatePassword = password_verify($passwd, $pass);
            if($authenticatePassword){
                $ses_data = [
                    //'id_employee' => $data['id_employee'],
                    //'lastname' => $data['lastname'], 
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                echo view('pages/home');
            
            }else{
                $session->setFlashdata('msg', "Ce n'est pas le bon mot de passe");
                echo view('pages/login');
            }

        }
        else{
            $session->setFlashdata('msg', " L'email utilisee n'est pas dans la base de donnees ");

            echo view('pages/login');
            echo $email ;

            echo $passwd;}

       /*if (isset($_POST['email']) && isset($_POST['passwd'])) {

            $email = htmlspecialchars($_POST['email']);
            $passwd = htmlspecialchars($_POST['passwd']);

            $check = $this->commandeModel->login($email);
            $check ->  execute ['email'];
            $data = $check-> getResult();
            $row = $check-> getrow();
            if ($row == 1) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $password = hash('SHA256', $passwd);
                    if ($data['passwd'] === $password) {
                        $_SESSION['email'] = $data['email'];
                        header('pages/home');
                    } else echo view('pages/login');
                } else echo view('pages/login');
            } else echo view('pages/login');
        } else echo view('pages/login');*/
    }

    public function importCsvToDb()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);

        if (!$input) {
            $data['validation'] = $this->validator;
            return view('/pages/prixhikvision', $data);
        } else {
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
                        $students = new CommandeModel();

                        $findRecord = $students->where('email', $userdata->email)->countAllResults();

                        if ($findRecord == 0) {
                            if ($students->insert($userdata)) {
                                $count++;
                            }
                        }
                    }
                    session()->setFlashdata('message', $count . ' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    session()->setFlashdata('message', 'CSV file coud not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            } else {
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }

        return redirect()->route('/');
    }
}
