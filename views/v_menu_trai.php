<?php //echo "<pre>",print_r($ds_cau_truc),"</pre>"; ?>
<div id="sidebar">
	<ul id="main-nav">
	  <li><a href="#" class="nav-top-item no-submenu">Danh mục </a> 
	  </li>
	  <li><a href="#" class="nav-top-item" id="dethi">Test TOEIC</a>
	    <ul>
	      <?php foreach ($ds_cau_truc as $cau_truc) {
		    ?>
		    <li><a href="de-chuan-<?php echo $cau_truc["ma_cau_truc"] ?><?php echo $cau_truc["ma_diem_chuan"] ?>" title="dethi" ><?php echo $cau_truc["ten_cau_truc"]; ?></a></li>
		    <?php 
			} 
			?>
	    </ul>
	  </li>
	  <li><a href="#" class="nav-top-item" id="luyentap">Luyện tập</a>
		    <ul>
		    	<?php foreach ($ds_bang_chuan as $bang_chuan) {
	  			?>
		     		<li><a href="#" title="luyentap"><?php echo $bang_chuan["diem_chuan"]; ?></a>
						<ul><?php
						foreach ($ds_luyen_tap as $luyen_tap) {
							if($bang_chuan["ma_diem_chuan"]==$luyen_tap["ma_diem_chuan"]){
								?>
								<li><a href="de-thi-<?php echo $luyen_tap["ma_cau_truc"] ?>-<?php echo $luyen_tap["ma_diem_chuan"] ?>"><?php echo $luyen_tap["ten_loai_noi_dung"] ?></a></li>
							<?php
						}
					}
						?></ul></li>
		    	<?php
				}
				?>
			</ul>
	  </li>
	 <li><a href="#" class="nav-top-item" id="dethi">Đề Thi Chuẩn</a>
	    <ul>
	      <?php foreach ($ds_de_chuan as $de_chuan) {
		    ?>
		    <li><a href="de-toeic-<?php echo $de_chuan["ma_cau_truc"] ?>" title="dethi" ><?php echo $de_chuan["ten_cau_truc"]; ?></a></li>
		    <?php 
			} 
			?>
	    </ul>
	  </li>
	</ul>
</div>