<?php
class Article
{
  public function __construct(private string $titre, private string $auteur, private string $contenu, private string $datePublication,) {}

  public function getTitre()
  {
    return $this->titre;
  }
  public function getAuteur()
  {
    return $this->auteur;
  }
  public function getContenu()
  {
    return $this->contenu;
  }
  public function getDatePublication()
  {
    return $this->datePublication;
  }
}

$article1 = new Article("la révolution française", "Robespierre", "Lorem ipsum", "2025-04-29");
echo $article1->getTitre();
