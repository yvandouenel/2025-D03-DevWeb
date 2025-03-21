let tresor = "diamant";
let argent = 1000;

function explorerCaverne() {
  let tresor = "or";
  console.log("Dans la caverne : " + tresor);

  {
    let tresor = "rubis";
    console.log("Dans la chambre secrète : " + tresor);
    console.log(`argent`, argent);
  }

  console.log("De retour dans la caverne : " + tresor);
  return tresor;
}

const tresorDansExplorerCaverne = explorerCaverne();
console.log("De retour au camp : " + tresor);
console.log("tresorDansExplorerCaverne : " + tresorDansExplorerCaverne);