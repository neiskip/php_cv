<?php
$connection = new PDO('sqlite:portfolio.sqlite');
$overallData = $connection->query('SELECT * FROM overall');
$overallData = $overallData->fetch(PDO::FETCH_ASSOC);
$sitesData = $connection->query('SELECT * FROM sites');
$aboutCareer = $connection->query("SELECT * FROM aboutCareer");
$aboutCareer = $aboutCareer->fetch(PDO::FETCH_ASSOC);
$experiences = $connection->query("SELECT * FROM experiences");
$skillsData = $connection->query("SELECT * FROM skills ORDER BY level DESC");
$otherSkills = [];
$educationData = $connection->query("SELECT * FROM education ORDER BY yearStart DESC");
$langData = $connection->query("SELECT * FROM languages");
$interestsData = $connection->query("SELECT * FROM interests");
?>
<!DOCTYPE html>
<html lang="ru"> 
<head>
    <title>Bootstrap 4 Резюме</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive Resume Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    
    <!-- FontAwesome JS-->
	<script defer src="assets/fontawesome/js/all.min.js"></script>
       
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/pillar-1.css">


</head> 

<body>	

    <article class="resume-wrapper text-center position-relative">
	    <div class="resume-wrapper-inner mx-auto text-left bg-white shadow-lg">
		    <header class="resume-header pt-4 pt-md-0">
			    <div class="media flex-column flex-md-row">
				    <img class="mr-3 img-fluid picture mx-auto" src="assets/images/profile.jpg" alt="">
				    <div class="media-body p-4 d-flex flex-column flex-md-row mx-auto mx-lg-0">
					    <div class="primary-info">
						    <h1 class="name mt-0 mb-1 text-white text-uppercase text-uppercase"><?=$overallData['name']?></h1>
						    <div class="title mb-3"><?=$overallData['post']?></div>
						    <ul class="list-unstyled">
							    <li class="mb-2"><a href="#"><i class="far fa-envelope fa-fw mr-2" data-fa-transform="grow-3"></i><?=$overallData['email']?></a></li>
							    <li><a href="#"><i class="fas fa-mobile-alt fa-fw mr-2" data-fa-transform="grow-6"></i><?=$overallData['phone']?></a></li>
						    </ul>
					    </div><!--//primary-info-->
					    <div class="secondary-info ml-md-auto mt-2">
						    <ul class="resume-social list-unstyled">
								<?php foreach($sitesData as $site): ?>
				                <li class="mb-3"><a href="#"><span class="fa-container text-center mr-2"><i class="<?=$site['class_name']?>"></i></span><?=$site['link']?></a></li>
								<?php endforeach; ?>
						    </ul>
					    </div><!--//secondary-info-->
					    
				    </div><!--//media-body-->
			    </div><!--//media-->
		    </header>
		    <div class="resume-body p-5">
			    <section class="resume-section summary-section mb-5">
				    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">О карьере</h2>
				    <div class="resume-section-content">
					    <p class="mb-0"><?=$aboutCareer['descr']?></p>
				    </div>
			    </section><!--//summary-section-->
			    <div class="row">
				    <div class="col-lg-9">
					    <section class="resume-section experience-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Опыт работы</h2>
						    <div class="resume-section-content">
							    <div class="resume-timeline position-relative">
									<?php foreach($experiences as $exp): ?>
								    <article class="resume-timeline-item position-relative pb-5">
									    
									    <div class="resume-timeline-item-header mb-2">
										    <div class="d-flex flex-column flex-md-row">
										        <h3 class="resume-position-title font-weight-bold mb-1"><?=$exp['post']?></h3>
										        <div class="resume-company-name ml-auto"><?=$exp['company']?></div>
										    </div><!--//row-->
										    <div class="resume-position-time"><?=$exp['yearStart']?> - <?=isset($exp['yearEnd']) ? $exp['yearEnd'] : 'Настоящее время'?></div>
									    </div><!--//resume-timeline-item-header-->
									    <div class="resume-timeline-item-desc">
										    <p><?=$exp['descr']?></p>
											<?php if(isset($exp['achievement'])): ?>
										    <h4 class="resume-timeline-item-desc-heading font-weight-bold">Достижения:</h4>
										    <p><?=$exp['achievement']?></p>
											<?php endif; ?>
									    </div><!--//resume-timeline-item-desc-->

								    </article><!--//resume-timeline-item-->
									<?php endforeach; ?>
							    </div><!--//resume-timeline-->
							    
							  
						    </div>
					    </section><!--//experience-section-->
				    </div>
				    <div class="col-lg-3">
					    <section class="resume-section skills-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Умения &amp; Инструменты</h2>
						    <div class="resume-section-content">
						        <div class="resume-skill-item">
							        <ul class="list-unstyled mb-4">
										<?php foreach($skillsData as $skill): ?>
										<?php if(isset($skill['level'])): ?>
								        <li class="mb-2">
								            <div class="resume-skill-name"><?=$skill['title']?></div>
									        <div class="progress resume-progress">
											    <div class="progress-bar theme-progress-bar-dark" role="progressbar" style="width: <?=(int)$skill['level']?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</li>
										<?php else: $otherSkills[]['title'] = $skill['title']; endif; ?>
										<?php endforeach; ?>
							        </ul>
						        </div><!--//resume-skill-item-->
						        
						        <div class="resume-skill-item">
						            <h4 class="resume-skills-cat font-weight-bold">Others</h4>
						            <ul class="list-inline">
									<?php foreach($otherSkills as $skill): ?>
							            <li class="list-inline-item"><span class="badge badge-light"><?=$skill['title']?></span></li>
										<?php endforeach; ?>
						            </ul>
						        </div><!--//resume-skill-item-->
						    </div><!--resume-section-content-->
					    </section><!--//skills-section-->
					    <section class="resume-section education-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Образование</h2>
						    <div class="resume-section-content">
							    <ul class="list-unstyled">
									<?php foreach($educationData as $edu): ?>
								    <li class="mb-2">
								        <div class="resume-degree font-weight-bold"><?= $edu['faculty'] ?></div>
								        <div class="resume-degree-org"><?= $edu['university'] ?></div>
								        <div class="resume-degree-time"><?= $edu['yearStart'] ?> - <?=isset($edu['yearEnd']) ? $edu['yearEnd'] : 'Настоящее время'?></div>
								    </li>
									<?php endforeach; ?>
							    </ul>
						    </div>
					    </section><!--//education-section-->
					    <section class="resume-section language-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Языки</h2>
						    <div class="resume-section-content">
							    <ul class="list-unstyled resume-lang-list">
									<?php foreach($langData as $lang): ?>
								    <li class="mb-2"><span class="resume-lang-name font-weight-bold"><?=$lang['title']?></span> <small class="text-muted font-weight-normal">(<?=$lang['level']?>)</small></li>
									<?php endforeach; ?>
							    </ul>
						    </div>
					    </section><!--//language-section-->
					    <section class="resume-section interests-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Хобби</h2>
						    <div class="resume-section-content">
							    <ul class="list-unstyled">
									<?php foreach($interestsData as $int): ?>
								    <li class="mb-1"><?=$int['title']?></li>
									<?php endforeach; ?>
							    </ul>
						    </div>
					    </section><!--//interests-section-->
					    
				    </div>
			    </div><!--//row-->
		    </div><!--//resume-body-->
		    
	    </div>
    </article>  

    
    <footer class="footer text-center pt-2 pb-5">
        <small class="copyright">Designed with <i class="fas fa-heart"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
    </footer>

</body>
</html> 

