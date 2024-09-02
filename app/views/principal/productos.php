<?php include 'app/views/layouts/header.php';?>
   <!-- inner page section -->
   <section class="inner_page_head">
      <div class="container_fuild">
         <div class="row">
            <div class="col-md-12">
               <div class="full">
                  <h3><?=$title?></h3>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end inner page section -->
   <!-- product section -->
   <section class="product_section layout_padding">
      <div class="container">
         <div class="heading_container heading_center">
               <span>Resultados: <?=$data['total']?></span>
         </div>
         <div class="row">
            <?php foreach ($data['data'] as $producto): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
               <!-- <div class="box">
                  <div class="option_container">
                     <div class="options">
                        <a href="<?=BASE_URL?>/productos/detalle/<?=$producto['familia']?>" target="_blank" class="option2">
                           <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <a href="" class="option1">
                           <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        </a>
                     </div>
                  </div>
                  <div class="img-box">
                     <img src="<?=$producto['imagen']?>" alt="" class="img-fluid">
                  </div>
                  <div class="detail-box">
                     <small><?=$producto['descripcion_comercial']?></small>
                  </div>
               </div> -->
               <!-- IMAGEN Y DATELLES CUSTOM -->
               <div class="card mb-3">
                  <img class="card-img-top" src="<?=$producto['imagen']?>" width="100%" height="200" alt="Image">
                  <div class="card-body">
                     <p class="small"><?=$producto['familia']?></p>
                     <small class="card-title"><?=$producto['descripcion_comercial']?></small>

                  </div>
                  <div class="card-footer text-center d-flex justify-content-between">
                     <a href="<?=BASE_URL?>/productos/detalle/<?=$producto['familia']?>" target="_blank" class="btn btn-outline-primary">
                        <i class="fa fa-eye"></i>
                     </a>
                     <a href="javascript:void(0)" class="btn btn-outline-success">
                        <i class="fa fa-cart-plus"></i>
                     </a>
                  </div>
               </div>
            </div>
            <?php endforeach;?>
         </div>
         <hr>
         <div class="row d-flex justify-content-between">
            <div class="col-md-6 d-flex justify-content-center align-items-center pb-3">
               Mostrando <?=$data['start_item']?> al <?=$data['end_item']?> de <?=$data['total']?>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
               <nav aria-label="Page navigation example">
                  <ul class="pagination">
                     <!-- Botón para ir al inicio -->
                     <li class="page-item <?=$data['prev_page_url'] === null ? 'disabled' : ''?>">
                     <a class="page-link" href="<?=$data['first_page_url']?>" aria-label="First">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                     </a>
                     </li>
                     <!-- Botón para ir a la anterior -->
                     <li class="page-item <?=$data['prev_page_url'] === null ? 'disabled' : ''?>">
                     <a class="page-link" href="<?=$data['prev_page_url']?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                     </a>
                     </li>
                     <?php for ($i = $data['start_page']; $i <= $data['end_page']; $i++): ?>
                     <li class="page-item <?=$i == $data['current_page'] ? 'active' : ''?>">
                        <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                     </li>
                     <?php endfor;?>
                     <!-- Botón para ir a la siguiente -->
                     <li class="page-item <?=$data['next_page_url'] === null ? 'disabled' : ''?>">
                     <a class="page-link" href="<?=$data['next_page_url']?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                     </a>
                     </li>
                     <!-- Botón para ir al final -->
                     <li class="page-item <?=$data['next_page_url'] === null ? 'disabled' : ''?>">
                     <a class="page-link" href="<?=$data['last_page_url']?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                     </a>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <div class="btn-box">
            <a href="<?=BASE_URL?>/productos">
            View All products
            </a>
         </div>
      </div>
   </section>
   <!-- end product section -->
<?php include 'app/views/layouts/footer.php';?>





