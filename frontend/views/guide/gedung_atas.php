<?php 
// echo '<pre>';
// print_r($model->guideProducts->product_product_id);die;
use yii\helpers\Url;
use common\models\Guide;
?>
<div role="main" class="main">

	<section class="page-header">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="/">Home</a></li>

				<li><a href="#">Pekerjaan Bangunan Gedung Atas</a></li>
				<li class="active"> <?=$model->guideCategory->guide_category_name; ?></li>
			</ul>
		</div>
	</section>


	<div class="container">

		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">

					<!-- <h4 class="heading-primary">Jenis Pekerjaan</h4>
					<div class="form-group">
						<select class="form-control mb-md">
							<option>Pekerjaan Bangunan Bawah</option>
							<option>Pekerjaan Bangunan Atas</option>
							<option>Infrastruktur Jalan &amp; Jembatan</option>
						</select>
					</div>

					<h4 class="heading-primary">Pekerjaan</h4>
					<div class="form-group">
						<select class="form-control mb-md">
							<option>Pekerjaan Struktur Beton Atas</option>
							<option>Pekerjaan Facades/option>
							<option>Pekerjaan MEP</option>
							<option>Pekerjaan Interior</option>
							<option>Pekerjaan Besi &amp; Baja</option>
						</select>
					</div> -->
					<?= $this->render('_form_kiri') ?>
					
					<hr>

					<h4 class="heading-primary" id="label_result_pekerjaan_default" style="display: show;"><?=$model->guideCategory->guide_category_name; ?></h4>
					<h4 class="heading-primary" id="label_result_pekerjaan" style="display:none;"></h4>

					<ul class="nav nav-list mb-xlg" id="result_pekerjaan" style="display: none;"">
<!-- 						<li><a href="pengangkatan-facades.html">Pengangkatan Facades</a></li>
						<li class="active" ><a href="pekerjaan-facades.html">Pasang Angkur</a></li>
						<li><a href="pasang-baking-rod.html">Pasang Backing Rod &amp; Sealant</a></li>
						<li><a href="test-tarik.html">Test Tarik</a></li> -->
					</ul>

					<ul class="nav nav-list mb-xlg" id="result_pekerjaan_default" style="display: block; ">
						 <?php $guideGuide = Guide::findAll(['guide_category_guide_category_id' =>  $model->guideCategory->guide_category_id, 'guide_status' => '1']); ?>
						 <?php foreach ($guideGuide as $key => $value) : ?>

							<!-- <li><a href="<?= $slug_prevent .'/' .$value->slug ?>"><?= ucwords(strtolower($value->guide_title)); ?></a></li> -->
							<li><a href="<?= Url::to(['guide/detail', 'slug' => $value->slug,  'slug_preven' => $slug_prevent])?> "><?= ucwords(strtolower($value->guide_title)); ?></a></li>
						 <?php endforeach; ?>
					</ul>

					<!-- <h4 class="heading-primary">Tentang Edukasi</h4>
					<p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. </p> -->

				</aside>
			</div>
			<div class="col-md-9">

				<h2><?=$model->guideCategory->guide_category_name; ?></h2>

				<hr>

				<div class="row">
					<div class="col-md-12">
						<p><?=$model->guide_post; ?></p>
						
						<div class="container-fluid mb-xlg">
			                <div class="row">
			                	<div class="col-sm-12">
			                		<h2 class="slider-title mt-sm">
					                    <span class="inline-title"><?=$model->guide_title; ?></span>
					                </h2>

					                <div class="row">

										<!-- <div class="product-img-box col-sm-6">

											<div class="product-img-box-wrapper">
			                                    <div class="product-img-wrapper">
			                                    	<?php 
			                                    		$imgOne = isset($model->guide_image) ? $model->guide_image : 'uploads/img/no-image.png';
			                                    	?>
			                                    	<img id="product-zoom" src="<?= Yii::getAlias('@web').'/'.$imgOne; ?>" data-zoom-image="<?= Yii::getAlias('@web').'/'.$imgOne; ?>" alt="Product main image">
			                                    </div>

												<a href="#" class="product-img-zoom" title="Zoom">
													<span class="glyphicon glyphicon-search"></span>
												</a>
											</div>
										</div> -->



										<!-- fase 2 -->

										<div class="product-img-box col-sm-5">
											<div class="product-img-box-wrapper">
			                                    <div class="product-img-wrapper">
			                                    	<?php 
			                                    	// echo '<pre>';
			                                    	// print_r($model->guideImagesNew[0]->productImage->image_thumbnail);die;
			                                    	?>

			                                    	<?php 
			                                    		$imgOne = isset($model->guideImagesNew[0]->productImage->image_url) ? $model->guideImagesNew[0]->productImage->image_url : 'uploads/img/no-image.png';
			                                    	?>
			                                    	<img id="product-zoom" src="<?= Yii::getAlias('@web').'/'.$imgOne; ?>" data-zoom-image="<?= Yii::getAlias('@web').'/'.$imgOne; ?>" alt="Product main image">
			                                    </div>

												<a href="#" class="product-img-zoom" title="Zoom">
													<span class="glyphicon glyphicon-search"></span>
												</a>
											</div>

											<div class="owl-carousel manual" id="productGalleryThumbs">

												<?php foreach ($model->guideImagesNew as $key => $dt) : ?>

													<?php  
													$imgAll = isset($dt->productImage->image_thumbnail) ? $dt->productImage->image_thumbnail : 'uploads/img/no-image.png';
													?>

													<div class="product-img-wrapper">
														<a href="#" data-image="<?= Yii::getAlias('@web').'/'.$imgAll; ?>" data-zoom-image="<?= Yii::getAlias('@web').'/'.$dt->productImage->image_url; ?>" class="product-gallery-item">
				                                            <img src="<?= Yii::getAlias('@web').'/'.$imgAll; ?>" width="600px" alt="product">
				                                        </a>
													</div>

												<?php endforeach; ?>
											</div>
										</div>

										<!-- end fase 2 -->

										<div class="col-sm-6">
											<h2>Peralatan &amp; Bahan Yang di perlukan</h2>

											<ul class="list list-icons list-icons-style-2 list-icons-sm">

												<?php if (!empty($model->prosedur_id)) : ?>
													<li><i class="fa fa-check"></i> <a href="#">Prosedur <?= $model->guideProsedur->prosedur_title?></a></li>
												<?php endif; ?>

												<?php 
													$product = \common\models\Product::find()->where(['product_id' => explode(',', $model->guideProducts->product_product_id)])->all();

												?>

												<?php foreach ($product as $key => $dt) : ?>
													<!-- <li><i class="fa fa-check"></i> <a href="<?= $dt->slug;?>"><?= $dt->product_name;?></a></li> -->
												<li><i class="fa fa-check"></i> <a href="<?= Url::to(['/guide/product', 'slug' => $dt->slug])?>"><?= $dt->product_name;?></a></li>

												<?php endforeach; ?>

											</ul>
										</div>
									</div>
			                	</div>
			                </div>
						</div>

						<div class="row">
							<div class="col-md-12">

							<h4>Gambar</h4>

								<ul class="nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter">
								</ul>

								<div class="row">

									<div class="sort-destination-loader sort-destination-loader-showing">
										<ul class="image-gallery sort-destination lightbox" data-sort-id="portfolio" data-plugin-options="{'delegate': 'a.lightbox-portfolio', 'type': 'image', 'gallery': {'enabled': true}}">

											<?php foreach ($product as $key => $gambar) : ?>
												<!-- $gambar->productImagesGuide->image_url -->
												<?php 
													$img = isset($gambar->productImagesGuide->image_url) ? $gambar->productImagesGuide->image_url : 'uploads/img/no-image.png';
												?>

												<li class="col-md-3 col-sm-6 col-xs-12 isotope-item">
													<div class="image-gallery-item">
														<a href="<?= Yii::getAlias('@web').'/'.$img?>" class="lightbox-portfolio">
															<span class="thumb-info">
																<span class="thumb-info-wrapper">
																	<img src="<?= Yii::getAlias('@web').'/'.$img?>" class="img-responsive" alt="">
																	<span class="thumb-info-title">
																		<span class="thumb-info-inner img-gallery-guide"><?= $gambar->product_name?></span>
																	</span>
																	<span class="thumb-info-action">
																		<span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
																	</span>
																</span>
															</span>
														</a>
													</div>
												</li>

											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>