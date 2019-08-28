 <nav class="navbar navbar-expand-lg bg-transparent">

     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"> <span><i class="fas fa-bars"></i></span>
     </button>

     <div class="collapse navbar-collapse" id="navbar">
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" href="index.php">Accueil</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="tchat.php">Tchat</a>
             </li>
             <?php if (isset($_SESSION['auth'])) : ?>
             <li class="nav-item">
                 <a class="nav-link" href="session.php">Mon compte</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="logOut.php">Déconnexion</a>
             </li>
             <?php else  : ?>          
             <li class="nav-item">
                 <a class="nav-link" href="formLogin.php">login</a>
             </li>
            <?php endif; ?>

            
         
         </ul>
     </div>
 </nav>

 