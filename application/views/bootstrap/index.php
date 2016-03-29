 
      
  </head>
  <body>
  <!--HEADER ROW-->
  <div id="header-row">
    <div class="container">
      <div class="row">
              <!--LOGO-->
              <div class="span3"><a class="brand" href="#"><img src="<?= base_url();?>assets/img/logo.png"/></a></div>
              <!-- /LOGO -->

            <!-- MAIN NAVIGATION -->  
              <div class="span9">
                <div class="navbar  pull-right">
                  <div class="navbar-inner">
                    <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
                    <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                        <li class="active"><a href="index.html">Home</a></li>
                        
                        <li class="dropdown">
                          <a href="about.html" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                  <li><a href="about.html">Company</a></li>
                                  <li><a href="about.html">History</a></li>
                                  <li><a href="about.html">Team</a></li>
                            </ul>

                        </li>

                        <li><a href="<?= base_url();?>welcome/services">Services</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li class="login">
                            <a data-toggle="modal" href="#loginForm"><i class="icon-lock"></i></a>
                        </li>
                 
                    </ul>
                  </div>

                  </div>
                </div>
              </div>
            <!-- MAIN NAVIGATION -->  
      </div>
    </div>
  </div>
  <!-- /HEADER ROW -->





<!--  Login form -->
<div class="modal hide fade in" id="loginForm" aria-hidden="false">
    <div class="modal-header">
        <i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
        <h4>Login Usuario</h4>
    </div>
    <!--Modal Body-->
    <div class="modal-body">


				<form id="formularioLogin"
					action="<?=base_url('usuario/loginUsuarioPost')?>" method="post"
					class="form-inline loginForm">


					

						
							<label>Email</label> <input type="text" name="email"
								id="email"
								value="<?php echo isset($email)?$email:''?>" class="input-login left-buffer">
						
							<label class="left-buffer">Contrase&ntilde;a</label> <input type="password" name="password"
								id="password" value="" class="input-login left-buffer">
															
				
				<?php if(isset($error)):?>
					<p class="error col-lg-8"><?=$error?></p>
				<?php endif;?>
				
				<?php if(isset($redireccion)):?>
					<input type="hidden" name="redireccion"
							value="<?php echo $redireccion?>" />
				<?php endif;?>					
				
				
							<input type="submit" value="Login"
								class="btn btn-primary left-buffer" tabindex="7">
						
						<p class="col-lg-3 top-buffer">
							<a href="<?=base_url('usuario/registrarUsuario')?>">Crear una
								cuenta</a>
						</p>


					

				</form>
    
    
    </div>
    <!--/Modal Body-->
</div>
<!--  /Login form -->





  


  <div class="container">

  <!--Carousel
  ==================================================-->

  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">

      <div class="active item">
        <div class="container">
          <div class="row">
            
              <div class="span6">

                <div class="carousel-caption">
                      <h1>Encuentra tu trayecto</h1>
                      <p class="lead">Crea o encuentra el trayecto que mejor se adapte a tus necesidades diarias. Reg&iacute;strate y encuentra a tu compa&ntilde;ero de viaje.</p>
                      <a class="btn btn-large btn-primary" href="<?= base_url();?>usuario/loginUsuario">Reg&iacute;strate gratis</a>
                </div>

              </div>

                <div class="span6"> <img src="<?= base_url();?>assets/img/slide/slide1.png"></div>

          </div>
        </div>
       



      </div>

      <div class="item">
       
        <div class="container">
          <div class="row">
            
              <div class="span6">

                <div class="carousel-caption">
                      <h1>Example headline</h1>
                      <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      <a class="btn btn-large btn-primary" href="#">Sign up today</a>
                </div>

              </div>

                <div class="span6"> <img src="<?= base_url();?>assets/img/slide/slide2.jpg"></div>

          </div>
        </div>

      </div>





    </div>
       <!-- Carousel nav -->
      <a class="carousel-control left " href="#myCarousel" data-slide="prev"><i class="icon-chevron-left"></i></a>
      <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="icon-chevron-right"></i></a>
        <!-- /.Carousel nav -->

  </div>
    <!-- /Carousel -->



<!-- Feature 
  ==============================================-->


  <div class="row feature-box">
      <div class="span12 cnt-title">
       <h1>At vero eos et accusamus et iusto odio dignissimos</h1> 
        <span>Contrary to popular belief, Lorem Ipsum is not simply random text.</span>        
      </div>

      <div class="span4">
        <img src="<?= base_url();?>assets/img/icon3.png">
        <h2>Feature A</h2>
        <p>
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
        </p>

        <a href="#">Read More &rarr;</a>

      </div>

      <div class="span4">
        <img src="<?= base_url();?>assets/img/icon2.png">
        <h2>Feature B</h2>
        <p>
            Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
            aliqua. 
        </p>   
          <a href="#">Read More &rarr;</a>    
      </div>

      <div class="span4">
        <img src="<?= base_url();?>assets/img/icon1.png">
        <h2>Feature C</h2>
        <p>
            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. 
        </p>
          <a href="#">Read More &rarr;</a>
      </div>
  </div>


<!-- /.Feature -->

  <div class="hr-divider"></div>

<!-- Row View -->


    <div class="row">
        <div class="span6"><img src="<?= base_url();?>assets/img/responsive.png"></div>

        <div class="span6">
          <img class="hidden-phone" src="<?= base_url();?>assets/img/icon4.png" alt="">
          <h1>Fully Responsive</h1>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
             <a href="#">Read More &rarr;</a>
        </div>
    </div>

    
</div>


<!-- /.Row View -->