<?php

namespace App\Src\Core;

class FormBuilder
{

    private $formCode = "";


    public function create()
    {
        return $this->formCode;
    }


    public static function validate(array $form, array $fields)
    {
        // On parcourt chaque champ
        foreach ($fields as $field) {
            // Si le champ est absent ou vide dans le tableau
            if (!isset($form[$field]) || empty($form[$field])) {
                // On sort en retournant false
                return false;
            }
        }
        // Ici le formulaire est "valide"
        return true;
    }


    private function ajoutAttributs(array $attributs): string
    {
        // On initialise une chaîne de caractères
        $str = '';

        // On liste les attributs "courts"
        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // On boucle sur le tableau d'attributs
        foreach ($attributs as $attribut => $valeur) {
            // Si l'attribut est dans la liste des attributs courts
            if (in_array($attribut, $courts) && $valeur == true) {
                $str .= " $attribut";
            } else {
                // On ajoute attribut='valeur'
                $str .= " $attribut='$valeur'";
            }
        }

        return $str;
    }

    public function debutForm(string $methode = 'post', string $action = '#', array $attributs = []): self
    {
        // On crée la balise form
        $this->formCode .= "<form action='$action' method='$methode'";

        // On ajoute les attributs éventuels
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        return $this;
    }


    public function finForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }


    public function ajoutLabelFor(string $for, string $texte, array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<label for='$for'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // On ajoute le texte
        $this->formCode .= ">$texte</label>";

        return $this;
    }


    public function ajoutInput(string $type, string $nom, array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<input type='$type' name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        return $this;
    }


    public function ajoutTextarea(string $nom, string $valeur = '', array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<textarea name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // On ajoute le texte
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }


    public function ajoutSelect(string $nom, array $options, array $attributs = []): self
    {
        // On crée le select
        $this->formCode .= "<select name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        // On ajoute les options
        foreach ($options as $valeur => $texte) {
            $this->formCode .= "<option value='$valeur'>$texte</option>";
        }

        // On ferme le select
        $this->formCode .= '</select>';

        return $this;
    }


    public function ajoutBouton(string $texte, array $attributs = []): self
    {
        // On ouvre le bouton
        $this->formCode .= '<button ';

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // On ajoute le texte et on ferme
        $this->formCode .= ">$texte</button>";

        return $this;
    }


    
}
