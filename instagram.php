<?php 	

				function GetInstagramImages($get = NULL){
					$images = array();
					if(!is_null($get)){
						if ($get['image_type'] == 'small') {
						$img_tpye = 'low_resolution';
						}elseif ($get['image_type'] == 'big') {
							$img_tpye = 'standard_resolution';
						}elseif ($get['image_type'] == 'thumb') {
							$img_tpye = 'thumbnail';
						}else{
							$img_tpye = 'thumbnail';
						}
						if(!is_null($get['width'])){ $res= 'width="'.$get['width'].'"';}else {$res = null;}
						$ins_user_url = 'http://www.instagram.com/'.$get['user_nick'].'/media/';
						$endata = file_get_contents($ins_user_url);
						$dedata = json_decode($endata,true);
						foreach($dedata['items'] as $dKey => $dResource){
							if($dedata['items'][$dKey]['type'] == 'image'){
								$images[]=$dedata['items'][$dKey];
							}	
						}
						if((count($images) - $get['limit']) < 1){
							$get['limit'] = count($images);
						}
						for ($i=0; $i < $get['limit']; $i++) { 
								print '<li class="col-md-2 no-padding"><a class="full-image" data-lightbox="ins_gallery" rel="gallery" data-lity target="_blank" rel="nofollow" href="'.$images[$i]['images']['standard_resolution']['url'].'"><img alt="'.$images[$i]['caption']['text'].'" '.$res.' src="'.$images[$i]['images'][$img_tpye]['url'].'"></a></li>';
						} 
					}
				}
				$args = array(
			    'user_nick'   => 'melih.duman',
			    'image_type'   => 'small',
			    'limit'   => 1,
			    'width'   => 350
				);
				GetInstagramImages($args);