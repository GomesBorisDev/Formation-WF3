6 écrans
Si l'utilisateur choisit oui on additionne le chiffre en haut à gauche

1
2
4
8
16
32

1/ on crée les variables qui vont permettre de faire l'addition à chaque fois que l'utilisateur dit oui

2/ écran 1 : 2 possibilités, il clique sur oui ou non

3/ on crée la fonction si il clique sur oui à l'écran 1
    
        - on a une première variable (calcul) avec sa valeur à 0
        - si oui, il faut qu'on ajoute 1 à la variable calcul
        - on va à la page 2 en passant la variable dans l'URL

4/ on crée la fonction si il clique sur non à l'écran 1

        - on n'ajoute rien à la variable calcul
        - on passe à la page 2 en passant la variable dans l'URL

5/ ecran 2 : 2 possibilités, oui ou non

6/ avant de faire les fonctions, je récupère la variable calcul dans l'URL

7/ on répète les étapes 3 et 4

8/ sur la dernière on a un message d'alerte qui affiche le résultat.

////////////////////////////////////////////

On fera un fichier JS par écran parce qu'on ne peut pas écouter un objet qui ne se trouve pas sur la page sur laquelle on travaille.