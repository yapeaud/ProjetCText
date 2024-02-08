<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Models\EtudiantRapport;
use App\Models\EtudiantEvalueMembre;
use App\Models\EtudiantEvalueTuteur;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    public function index()
    {
        return view('etudiant.index');
    }

    public function inscription()
    {
        return view('etudiant.inscription');
    }

    public function traitementInscriptionEtudiant(Request $request)
    {
        //Validation des données
        $request->validate([]);
        $etudiant = new Etudiant;
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->contact = $request->input('contact');
        $etudiant->email = $request->input('email');
        $etudiant->mot_de_passe  = Hash::make($request->input('mdp'));
        $etudiant->save();
        return back()->with("successAdd", "Inscription reçue.");
    }

    public function listeEtudiant()
  {
    $etudiants = Etudiant::all();
    return view('etudiant.liste', compact('etudiants'));
  }

  public function etudiantDasboard()
  {
    return view('etudiant.dashboard');
  }

  public function etudiantEvalueMembre()
  {
    $etudiant_evalue_membres = EtudiantEvalueMembre::all();
    return view('etudiant.membre', compact('etudiant_evalue_membres'));
  }

  public function traitementEtudiantEvalueMembre(Request $request)
  {
    //Validation des données
    $request->validate([]);
    $etudiant_evalue_membre = new EtudiantEvalueMembre;
    $etudiant_evalue_membre->save();
    return back()->with("successAdd", 'La note a été enregistrée avec succès.');
  }

  public function etudiantEvalueTuteur()
  {
    $etudiant_evalue_tuteurs = EtudiantEvalueTuteur::all();
    return view('etudiant.tuteur', compact('etudiant_evalue_tuteurs'));
  }

  public function traitementEtudiantEvalueTuteur(Request $request)
  {
    //Validation des données
    $request->validate([]);
    $etudiant_evalue_tuteur = new EtudiantEvalueTuteur;
    $etudiant_evalue_tuteur->save();
    return back()->with("successAdd", 'La note a été enregistrée avec succès.');
  }

  public function etudiantRapport()
  {
    $etudiant_rapports = EtudiantRapport::all();
    return view('etudiant.rapport', compact('etudiant_rapports'));
  }

  public function traitementEtudiantRapport(Request $request)
  {
    $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'required|mimes:docx,xlsx,pptx,pdf,sql|max:10000000'
    ]);

    $title = $request->input('title');
    $file = $request->file('file');
    
    $fileName = $title . '_' . time() . '.' . $file->getClientOriginalExtension();
   
    $path = $file->storeAs('uploads', $fileName);

    $etudiant_rapport = new EtudiantRapport;
    $etudiant_rapport->nom_du_rapport = $request->input('title');
    $etudiant_rapport->file = $request->input('file');

    return back()->with("successAdd", 'Votre rapport a été déposé.');

  }
}
