<?php
function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "<img src='img/iconos/atras.png' />";
	$nextlabel = "<img src='img/iconos/next.png' />";
	$out = '<ul class="pagination pagination-large">';
	

	if($page==1) {
		$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
	}else {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";

	}
	
	if($page>($adjacents+1)) {
		$out.= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
	}

	if($page>($adjacents+2)) {
		$out.= "<li><a style='color:#fff;'>...</a></li>";
	}


	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active'><a style='color:#fff;'>$i</a></li>";
		}else if($i==1) {
			$out.= "<li><a style='color:#fff;' href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
		}else {
			$out.= "<li><a style='color:#fff;' href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
		}
	}


	if($page<($tpages-$adjacents-1)) {
		$out.= "<li><a>...</a></li>";
	}

	if($page<($tpages-$adjacents)) {
		$out.= "<li class='color:red;'><a href='javascript:void(0);' style='color:#fff;' onclick='load($tpages)'>$tpages</a></li>";
	}

	if($page<$tpages) {
		$out.= "<li><span><a href='javascript:void(0);' style='color:#fff;' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
	}else {
		$out.= "<li class='disabled' style='color:#fff;'><span style='color:#fff;'><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}
?>