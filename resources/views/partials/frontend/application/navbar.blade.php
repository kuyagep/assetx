 <nav class="main-header navbar navbar-expand-md navbar-dark accent-navy bg-black ">
     <div class="container">
         <a href="javascript:void(0);" class="navbar-brand mt-2 text-white">
             <img src="{{ asset('brand_logo/logo.png') }}" alt="Logo" class="brand-image  elevation-0"
                 style="opacity: .8; height: 70px;">
         </a>

         <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
             aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>



         <!-- Right navbar links -->
         <div class="text-center collapse navbar-collapse order-2" id="navbarCollapse">
             <ul class=" order-md-2 navbar-nav navbar-no-expand ml-auto">

                 <li class="nav-item">
                     <span href="javascript:void(0)" aria-expanded="false" class="nav-link text-white">
                         <div class="current-date" id="current-date"> </div>
                     </span>
                 </li>
             </ul>
         </div>

     </div>
 </nav>
