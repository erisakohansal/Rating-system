<?php
$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");
// requete SELECT COUNT(*) FROM Reviewmavhin;
// AVG = Moyenne SUM = addition COUNT = compteur
$count="SELECT COUNT(*) FROM `review_table`";
$avg="SELECT AVG(user_rating) FROM `review_table`";
$progress_count1="SELECT COUNT(user_rating) FROM `review_table` WHERE user_rating=1";
$progress_count2="SELECT COUNT(user_rating) FROM `review_table` WHERE user_rating=2";
$progress_count3="SELECT COUNT(user_rating) FROM `review_table` WHERE user_rating=3";
$progress_count4="SELECT COUNT(user_rating) FROM `review_table` WHERE user_rating=4";
$progress_count5="SELECT COUNT(user_rating) FROM `review_table` WHERE user_rating=5";


function cacul_pourcentage($nombre,$total,$pourcentage){ 
	$resultat = (number_format($nombre, 1)/number_format($total, 1)) * number_format($pourcentage, 1);
    return number_format($resultat,1); 
} 
/*$total=0;
foreach ($connect->query($progress) as $rate) {
	$num=0;
	if ($rate[0]=4) {
		$num++;
	}
	foreach ($req as $row) {
		$total= $row[0];
		if ($total==0) {
			echo 0;
		} else {
			echo cacul_pourcentage($num,$total,100);
		}
	}*/

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Review & Rating System in PHP & Mysql using Ajax</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<style>
            .progress-label-left {
                float: left;
                margin-right: 0.5em;
                line-height: 1em;
            }
            .progress-label-right {
                float: right;
                margin-left: 0.3em;
                line-height: 1em;
            }
            .star-light {
                color:#e9ecef;
            }
			.progress-bar {
				
			}
        </style>
	</head>
	<body>
		<div class="container">
			<h1 class="mt-5 mb-5">Donner votre avis</h1>
			<div class="card">
				<div class="card-header">nom de prof</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4 text-center">
							<h1 class="text-warning mt-4 mb-4">
								<b><span id="average_rating">
									<?php 
									foreach  ($connect->query($avg) as $row) {
										echo number_format($row[0],1);
									}
									?>
								</span> / 5</b>
							</h1>
							<div class="mb-3">
								<i class="fas fa-star star-light mr-1 main_star"></i>
								<i class="fas fa-star star-light mr-1 main_star"></i>
								<i class="fas fa-star star-light mr-1 main_star"></i>
								<i class="fas fa-star star-light mr-1 main_star"></i>
								<i class="fas fa-star star-light mr-1 main_star"></i>
							</div>
							<h3><span id="total_review">
								<?php  
								foreach ($connect->query($count) as $row) {
									echo $row[0];
								}
								?></span> Avis</h3>
						</div>
						<div class="col-sm-4">
							<p>
								<div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

								<div class="progress-label-right">(<span id="total_five_star_review"><?php
									foreach ($connect->query($progress_count5) as $row) {
										echo $row[0];
									}
									?></span>)</div>
								<div class="progress">
									<div id="progress_bar5" onload="progress5" class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
								</div>
							</p>
							<p>
								<div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
								
								<div class="progress-label-right">(<span id="total_four_star_review"><?php
									foreach ($connect->query($progress_count4) as $row) {
										echo $row[0];
									}
									?></span>)</div>
								<div class="progress">
									<div id="progress_bar4" class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
								</div>               
							</p>
							<p>
								<div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
								
								<div class="progress-label-right">(<span id="total_three_star_review"><?php
									foreach ($connect->query($progress_count3) as $row) {
										echo $row[0];
									}
									?></span>)</div>
								<div class="progress">
									<div id="progress_bar3" class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
								</div>               
							</p>
							<p>
								<div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
								
								<div class="progress-label-right">(<span id="total_two_star_review"><?php
									foreach ($connect->query($progress_count2) as $row) {
										echo $row[0];
									}
									?></span>)</div>
								<div class="progress">
									<div id="progress_bar2" class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
								</div>               
							</p>
							<p>
								<div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
								
								<div class="progress-label-right">(<span id="total_one_star_review"><?php
									foreach ($connect->query($progress_count1) as $row) {
										echo $row[0];
									}
									?></span>)</div>
								<div class="progress">
									<div id="progress_bar1" class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
								</div>               
							</p>
						</div>
						<div class="col-sm-4 text-center">
							<h3 class="mt-4 mb-3">Ecrivez votre avis</h3>
							<button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
						</div>
					</div>
				</div>
			</div>
			<div class="mt-5" id="review_content"></div>
		</div>
		<div id="review_modal" class="modal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Infos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h4 class="text-center mt-2 mb-4">
							<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
							<i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
							<i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
							<i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
							<i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
						</h4>
						<div class="form-group">
							<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Entrer votre nom" />
						</div>
						<div class="form-group">
							<textarea name="user_review" id="user_review" class="form-control" placeholder="Ecrivez votre avis ici"></textarea>
						</div>
						<div class="form-group text-center mt-4">
							<button type="button" class="btn btn-primary" id="save_review">Envoyer</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="jquery.js"></script>
	</body>
</html>





