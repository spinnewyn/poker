<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Poker</title>
</head>

<body>
</body>

<script>


    class Poker {
        constructor(n, c, x, y) {
            this.n = n;
            this.c = c;
            this.x= x;
            this.y= y;
        }


        display(){
            var ch =`
      <div id="${this.n}" style="border-style: double;position:absolute;top:${this.y}px;left:${this.x}px;width:auto">
        <form>
          <fieldset style="background-color:${this.c}">
            <input type="button" value="Tirage" onClick="tirage(this.form)">
            <img name="image" src="Cartes/DOS.gif" width="106" height="136" border="0" alt="">
            <img name="image" src="Cartes/DOS.gif" width="106" height="136" border="0" alt="">
            <img name="image" src="Cartes/DOS.gif" width="106" height="136" border="0" alt="">
            <img name="image" src="Cartes/DOS.gif" width="106" height="136" border="0" alt="">
            <img name="image" src="Cartes/DOS.gif" width="106" height="136" border="0" alt="">
            <input type="text" name="resultat" placeholder="resultat"><br>
            </fieldset>
        </form>
      </div>`;
            document.getElementsByTagName("body")[0].innerHTML+=ch;
        }

    }

    function tirage(f) {
        f.resultat.value = ''
        var tabSigne = ['C','P','H','T']
        var listeCartes =[];
        var tabNum = [];
        var tabCouleur = [];
        for (var i = 0; i < 5; i++) {
            var trouve =false
            while (!trouve) {
                var numCarte = Math.floor(Math.random() * 11+1)
                var signeCarte = tabSigne[Math.floor(Math.random() * 3)]
                var carte = 'Cartes/'+numCarte+signeCarte+'.GIF'
                if(listeCartes.indexOf(carte)==-1){
                    trouve=true
                }
            }
            listeCartes.push(carte)
            tabNum.push(numCarte)
            tabCouleur.push(signeCarte)
            f.image[i].src= carte
        }
        var boolCarre = false;
        var nbPaire = 0;
        var res={"pair":0,"brelan":0, "carre":0};
        var carte = [];
        for (var x of tabNum) {
            var nbNum = 0;
            for (var i of tabNum) {
                if (i == x) {nbNum++;}
                if(nbNum==3){
                    res.brelan = 1;
                    carte.push(x);
                    f.resultat.value = "Brelan de "+x;
                }
                else if(nbNum==4){
                    boolCarre = true;
                    carte = x
                }

            }
            if (nbNum==2){
                res.pair = 1;
                nbPaire = nbPaire +1;
                if(nbPaire <3)
                    carte.push(x);
                else
                    carte.push(x);
            }
        }
        var unique = carte.filter((v, i, a) => a.indexOf(v) === i);
        if(nbPaire ==2)
            f.resultat.value = "pair de "+unique[0];
        if (nbPaire==4 && boolCarre == false){
            f.resultat.value = "double pair de "+unique[0]+" et de "+unique[1]
        }
        if (boolCarre){
            f.resultat.value = "carre de "+unique[0];
        }
        if(res.pair == 1 && res.brelan == 1){
            f.resultat.value = "full de "+unique[0]+" et de "+unique[1];
        }

        if (suite(tabNum)) {
            f.resultat.value = 'Suite';
        }

        if(couleur(tabCouleur)) {
            f.resultat.value = 'Couleur';
        }

        if(res.pair == 1 && res.brelan == 1){
            f.resultat.value = "full de "+carte[0]+" et de "+carte[1];
        }

        if (boolCarre){
            f.resultat.value = "carre de "+carte[0];
        }

        if (suite(tabNum) && couleur(tabCouleur)) {
            f.resultat.value = 'QuinteFlush';
        }

        if ((tabNum[0]==1 && tabNum[1]==10 && tabNum[2]==11 && tabNum[3]==12 && tabNum[4]==13) && couleur(tabCouleur)) {
            f.resultat.value = 'QuinteFlush Royale';
        }

    }

    function compare(a, b) {
        return a - b;
    }

    function couleur(tabCouleur) {
        var boolCouleur = false;
        for (var x of tabCouleur) {
            var nbCouleur = 0;
            for (var i of tabCouleur) {
                if (i == x) {
                    nbCouleur = nbCouleur+1;
                }
                if (nbCouleur==5) {
                    boolCouleur = true;
                }
            }
        }
        return boolCouleur;
    }

    function suite(tabNum) {
        tabNum.sort(compare);
        var nbSuite = 0;
        for (var i = 0; i < 4; i++) {
            if (tabNum[i] == tabNum[i+1]-1) {
                nbSuite++;
            }
        }

        if ((nbSuite == 4) || (tabNum[0]==1 && tabNum[1]==10 && tabNum[2]==11 && tabNum[3]==12 && tabNum[4]==13)){
            return true;
        }
        else {
            return false;
        }
    }

    var jeu1 = new Poker(jeu1,'red',50,50);
    var jeu2 = new Poker(jeu2,'blue',250,250);
    var jeu3 = new Poker(jeu3,'yellow',550,550);

    jeu1.display();
    jeu2.display();
    jeu3.display();

</script>

</html>